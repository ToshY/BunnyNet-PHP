<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

use ToshY\BunnyNet\Enum\Type;
use ToshY\BunnyNet\Exception\KeyFormatNotSupportedException;

/**
 * @link https://support.bunny.net/hc/en-us/articles/360016055099-How-to-sign-URLs-for-BunnyCDN-Token-Authentication
 * @link https://github.com/BunnyWay/BunnyCDN.TokenAuthentication
 */
final class SecureUrlGenerator
{
    /** Pull Zone Url Token Authentication Key.*/
    private readonly string $token;

    /**
     * @throws KeyFormatNotSupportedException
     */
    public function __construct(
        private readonly string $hostname,
        string $token
    ) {
        if (preg_match(Type::UUID36_TYPE->value, $token) !== 1) {
            throw new KeyFormatNotSupportedException(
                'Invalid token: does not conform to the UUID 36 characters format.'
            );
        }
        $this->token = $token;
    }

    public function generate(
        string $file,
        int $expirationTime = 3600,
        string|null $userIp = null,
        bool $isDirectoryToken = false,
        string|null $pathAllowed = null,
        string|null $countriesAllowed = null,
        string|null $countriesBlocked = null,
        string|null $referrersAllowed = null,
        bool $allowSubnet = true
    ): string {
        $url = sprintf('%s%s', $this->hostname, $file);

        // Parse optional path parameters
        $this->parseOptionalPathParameter($url, 'token_countries', $countriesAllowed);
        $this->parseOptionalPathParameter($url, 'token_countries_blocked', $countriesBlocked);
        $this->parseOptionalPathParameter($url, 'token_referer', $referrersAllowed);

        $urlScheme = parse_url($url, PHP_URL_SCHEME);
        $urlHost = parse_url($url, PHP_URL_HOST);
        $urlPath = parse_url($url, PHP_URL_PATH);
        $urlQuery = parse_url($url, PHP_URL_QUERY) ?? '';

        $parameters = [];
        parse_str($urlQuery, $parameters);

        // If path is specified, overwrite
        $signaturePath = $urlPath;
        if ($pathAllowed !== null) {
            $signaturePath = $pathAllowed;
            $parameters['token_path'] = $signaturePath;
        }

        // Parameter data
        ksort($parameters);
        $parameterData = '';
        $parameterDataUrl = '';
        if (sizeof($parameters) > 0) {
            foreach ($parameters as $key => $value) {
                if (strlen($parameterData) > 0) {
                    $parameterData .= '&';
                }

                $parameterDataUrl .= '&';
                $parameterData .= sprintf('%s=%s', $key, $value);
                $parameterDataUrl .= sprintf('%s=%s', $key, urlencode($value));
            }
        }

        // Generate the token
        $expires = time() + $expirationTime;
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

    private function parseOptionalPathParameter(
        string &$url,
        string|null $pathParameterKey,
        string|null $pathParameterValue
    ): void {
        if ($pathParameterValue === null) {
            return;
        }

        $url .= empty(parse_url($url, PHP_URL_QUERY)) === true ? '?' : '&';
        $url .= sprintf('%s=%s', $pathParameterKey, $pathParameterValue);
    }
}
