<?php

/**
 * Written by ToshY, <24-10-2021>
 */

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\UuidType;
use ToshY\BunnyNet\Exception\KeyFormatNotSupported;

/**
 * Class SecureUrl
 */
final class SecureUrl
{
    /**
     * Pull Zone (custom) hostname, including scheme:
     * e.g. `https://files-example.b-cdn.net` or `https://files.example.com`.
     * @var string
     */
    private string $hostname;

    /**
     * Pull Zone Url Token Authentication Key.
     * @var string
     */
    private string $token;

    /**
     * SecureUrl constructor.
     * @param string $hostname
     * @param string $token
     * @throws KeyFormatNotSupported
     */
    public function __construct(string $hostname, string $token)
    {
        $this->hostname = $hostname;

        if (preg_match(UuidType::UUID_36, $token) !== 1) {
            throw new KeyFormatNotSupported(
                'Invalid token: does not conform to the UUID 36 characters format.'
            );
        }
        $this->token = $token;
    }

    /**
     * Generate URL with token/directory authentication.
     * @param string $file
     * @param int $expirationTime
     * @param string|null $userIp
     * @param bool $isDirectoryToken
     * @param bool|null $pathAllowed
     * @param bool|null $countriesAllowed
     * @param bool|null $countriesBlocked
     * @param bool|null $referrersAllowed
     * @param bool $allowSubnet
     * @return string
     */
    public function generate(
        string $file,
        int $expirationTime = 3600,
        ?string $userIp = null,
        bool $isDirectoryToken = false,
        ?bool $pathAllowed = null,
        ?bool $countriesAllowed = null,
        ?bool $countriesBlocked = null,
        ?bool $referrersAllowed = null,
        bool $allowSubnet = true
    ): string {
        $url = sprintf('%s%s', $this->hostname, $file);

        if ($countriesAllowed !== null) {
            $url .= (parse_url($url, PHP_URL_QUERY) == "") ? "?" : "&";
            $url .= "token_countries={$countriesAllowed}";
        }

        if ($countriesBlocked !== null) {
            $url .= (parse_url($url, PHP_URL_QUERY) == "") ? "?" : "&";
            $url .= "token_countries_blocked={$countriesBlocked}";
        }

        if ($referrersAllowed !== null) {
            $url .= (parse_url($url, PHP_URL_QUERY) == "") ? "?" : "&";
            $url .= "token_referer={$referrersAllowed}";
        }

        $urlScheme = parse_url($url, PHP_URL_SCHEME);
        $urlHost = parse_url($url, PHP_URL_HOST);
        $urlPath = parse_url($url, PHP_URL_PATH);
        $urlQuery = parse_url($url, PHP_URL_QUERY) ?? '';

        $parameters = [];
        parse_str($urlQuery, $parameters);

        // Check if the path is specified and overwrite the default
        $signaturePath = $urlPath;

        if ($pathAllowed !== null) {
            $signaturePath = $pathAllowed;
            $parameters['token_path'] = $signaturePath;
        }

        // Expiration time
        $expires = time() + $expirationTime;

        // Construct the parameter data; sort alphabetically, very important
        ksort($parameters);
        $parameterData = "";
        $parameterDataUrl = "";
        if (sizeof($parameters) > 0) {
            foreach ($parameters as $key => $value) {
                if (strlen($parameterData) > 0) {
                    $parameterData .= "&";
                }

                $parameterDataUrl .= "&";

                $parameterData .= sprintf('%s=%s', $key, $value);
                $parameterDataUrl .= sprintf('%s=%s', $key, urlencode($value));
            }
        }

        // Generate the token
        $hashableBase = sprintf('%s%s%s', $this->token, $signaturePath, $expires);

        // If using IP validation
        if ($userIp !== null) {
            // Allow subnet to reduce false negatives (IPv4)
            if ($allowSubnet === true) {
                $hashableBase .= preg_replace('/^([\d]+.[\d]+.[\d]+).[\d]+$/', '$1.0', $userIp);
            }
            $hashableBase .= $userIp;
        }
        $hashableBase .= $parameterData;

        // Generate the token
        $token = hash('sha256', $hashableBase, true);
        $token = base64_encode($token);
        $token = strtr($token, '+/', '-_');
        $token = str_replace('=', '', $token);

        if ($isDirectoryToken === true) {
            return sprintf(
                '%s://%s/bcdn_token=%s&expires=%s%s%s',
                $urlScheme,
                $urlHost,
                $token,
                $expires,
                $parameterDataUrl,
                $urlPath
            );
        }

        return sprintf(
            '%s://%s%s?token=%s%s&expires=%s',
            $urlScheme,
            $urlHost,
            $urlPath,
            $token,
            $parameterDataUrl,
            $expires
        );
    }
}
