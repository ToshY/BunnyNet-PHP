<?php

declare(strict_types=1);

namespace ToshY\BunnyNet;

/**
 * Token authentication system to strictly control who, where and for how long can access your content.
 *
 * Provide the API key of the specific pull zone you want to use, available at the **Url Token Authentication Key** section.
 *
 * ```php
 * <?php
 *
 * require 'vendor/autoload.php';
 *
 * use ToshY\BunnyNet\SecureUrlGenerator;
 *
 * $bunnySecureUrl = new SecureUrlGenerator(
 *     token: '5509f27d-9103-4de6-8370-8bd68db859c9',
 *     hostname: 'https://custom-pullzone.b-cdn.net'
 * );
 * ```
 *
 * @link https://support.bunny.net/hc/en-us/articles/360016055099-How-to-sign-URLs-for-BunnyCDN-Token-Authentication
 * @link https://github.com/BunnyWay/BunnyCDN.TokenAuthentication
 */
class SecureUrlGenerator
{
    /**
     * @param string $token
     * @param string $hostname
     */
    public function __construct(
        private readonly string $token,
        private readonly string $hostname,
    ) {
    }

    /**
     * Generate secure URL.
     *
     * ```php
     * // File from root directory.
     * $bunnySecureUrl->generate(
     *     file: '/bunny.jpg',
     *     expirationTime: 3600,
     *     userIp: null,
     *     isDirectoryToken: false,
     *     pathAllowed: null,
     *     countriesAllowed: null,
     *     countriesBlocked: null,
     *     referrersAllowed: null,
     *     allowSubnet: true
     * );
     *
     * // File from subdirectory.
     * $bunnySecureUrl->generate(
     *     file: '/css/custom.css'
     * );
     *
     * // With IPv4.
     * $bunnySecureUrl->generate(
     *     file: '/css/custom.css',
     *     userIp: '12.345.67.89'
     * );
     *
     * // With directory token enabled and path specified for video streaming
     * $bunnySecureUrl->generate(
     *     file: '/videos/awesome.m3u8',
     *     userIp: '12.345.67.89',
     *     isDirectoryToken: true,
     *     pathAllowed: '/videos'
     * );
     *
     * // Allow or block certain countries, e.g. allow "US" and block "RU".
     * $bunnySecureUrl->generate(
     *     file: '/videos/awesome.m3u8',
     *     userIp: '12.345.67.89',
     *     isDirectoryToken: true,
     *     pathAllowed: '/videos'
     *     countriesAllowed: 'US',
     *     countriesBlocked: 'RU'
     * );
     *
     * // Allow or block certain countries, e.g. allow "US" and block "RU".
     * $bunnySecureUrl->generate(
     *     file: '/videos/awesome.m3u8',
     *     userIp: '12.345.67.89',
     *     isDirectoryToken: true,
     *     pathAllowed: '/videos'
     *     referrersAllowed: 'example.com'
     * );
     * ```
     *
     * ---
     * Notes:
     * - Token IP validation only supports IPv4.
     * - In order to reduce the false negatives (and increase privacy) for Token IP validation, the default is to
     * allow the full /24 subnet.
     *   - Example: A token generated for an user with IPv4 `12.345.67.89` will allow the subnet `12.345.67.0`, to watch the content.
     * - Both `countries` and `referers` accept comma separated input, meaning you could allow or block multiple countries like
     * so: `US,DE,JP`. Same for referers: `example.com,example.org`.
     * - An edge case occurs when you add a blocked country to the Traffic Manager, and allow that same country for
     * token authentication. This will result in a standard "Unable to connect" page. According to support "The reason for
     * that would be is due to the fact that the Traffic manager doesn't resolve
     * the DNS from that country and in turn, we start returning 127.0.0.1 queries towards the hostnames in use instead
     * of the standard CDN routing. The traffic essentially doesn't even touch our servers in such a case."
     * ---
     *
     * @param string $file
     * @param int $expirationTime
     * @param string|null $userIp
     * @param bool $isDirectoryToken
     * @param string|null $pathAllowed
     * @param string|null $countriesAllowed
     * @param string|null $countriesBlocked
     * @param string|null $referrersAllowed
     * @param bool $allowSubnet
     * @return string
     */
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

        $this->parseOptionalPathParameter($url, 'token_countries', $countriesAllowed);
        $this->parseOptionalPathParameter($url, 'token_countries_blocked', $countriesBlocked);
        $this->parseOptionalPathParameter($url, 'token_referer', $referrersAllowed);

        $urlScheme = parse_url($url, PHP_URL_SCHEME);
        $urlHost = parse_url($url, PHP_URL_HOST);
        $urlPath = parse_url($url, PHP_URL_PATH);
        $urlQuery = parse_url($url, PHP_URL_QUERY) ?? '';

        $parameters = [];
        parse_str($urlQuery, $parameters);

        $signaturePath = $urlPath;
        if ($pathAllowed !== null) {
            $signaturePath = $pathAllowed;
            $parameters['token_path'] = $signaturePath;
        }

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

        $expires = time() + $expirationTime;
        $hashableBase = sprintf('%s%s%s', $this->token, $signaturePath, $expires);

        // Check for IP validation; Additional check to allow subnet to reduce false negatives (IPv4).
        if (null !== $userIp) {
            if (true === $allowSubnet) {
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

        if (true === $isDirectoryToken) {
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

    /**
     * @ignore
     * @param string $url
     * @param string|null $pathParameterKey
     * @param string|null $pathParameterValue
     * @return void
     */
    private function parseOptionalPathParameter(
        string &$url,
        string|null $pathParameterKey,
        string|null $pathParameterValue
    ): void {
        if (null === $pathParameterValue) {
            return;
        }

        $url .= empty(parse_url($url, PHP_URL_QUERY)) === true ? '?' : '&';
        $url .= sprintf('%s=%s', $pathParameterKey, $pathParameterValue);
    }
}
