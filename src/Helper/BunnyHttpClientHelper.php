<?php

declare(strict_types=1);

namespace ToshY\BunnyNet\Helper;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use Throwable;
use ToshY\BunnyNet\Attributes\BodyProperty;
use ToshY\BunnyNet\Attributes\HeaderProperty;
use ToshY\BunnyNet\Attributes\PathProperty;
use ToshY\BunnyNet\Attributes\QueryProperty;
use ToshY\BunnyNet\Enum\MimeType;
use ToshY\BunnyNet\Exception\Client\BunnyHttpClientResponseException;
use ToshY\BunnyNet\Exception\Client\BunnyJsonException;
use ToshY\BunnyNet\Model\Client\BunnyHttpClientPayload;
use ToshY\BunnyNet\Model\Client\BunnyHttpClientResponse;
use ToshY\BunnyNet\Model\Client\BunnyHttpClientResponseInterface;
use ToshY\BunnyNet\Model\ModelInterface;

use const JSON_BIGINT_AS_STRING;
use const JSON_THROW_ON_ERROR;

/**
 * @internal
 */
class BunnyHttpClientHelper
{
    public static function createPayload(ModelInterface $model): BunnyHttpClientPayload
    {
        $apiModel = new BunnyHttpClientPayload();

        $reflection = new ReflectionClass($model);
        foreach ($reflection->getProperties() as $property) {
            if ($property->getAttributes(PathProperty::class)) {
                $apiModel->path[$property->getName()] = $property->getValue($model);
                continue;
            }

            if ($property->getAttributes(QueryProperty::class)) {
                $apiModel->query = $property->getValue($model);
                continue;
            }

            if ($property->getAttributes(BodyProperty::class)) {
                $apiModel->body = $property->getValue($model);

                continue;
            }

            if ($property->getAttributes(HeaderProperty::class)) {
                $apiModel->headers[$property->getName()] = $property->getValue($model);
            }
        }

        return $apiModel;
    }

    public static function createPath(
        ModelInterface $model,
        BunnyHttpClientPayload $payload,
    ): string {
        return sprintf(
            sprintf(
                '/%s',
                $model->getPath(),
            ),
            ...$payload->path,
        );
    }

    public static function createQuery(BunnyHttpClientPayload $payload): string|null
    {
        $query = $payload->query;

        if (true === empty($query)) {
            return null;
        }

        foreach ($query as $key => $value) {
            if (false === is_bool($value)) {
                continue;
            }

            $query[$key] = $value ? 'true' : 'false';
        }

        return sprintf(
            '?%s',
            http_build_query(
                data: $query,
                arg_separator: '&',
                encoding_type: PHP_QUERY_RFC3986,
            ),
        );
    }

    public static function createUrl(
        string $baseUrl,
        string $path,
        string $query,
    ): string {
        return sprintf(
            'https://%s%s%s',
            $baseUrl,
            $path,
            $query,
        );
    }

    /**
     * @param ModelInterface $model
     * @param BunnyHttpClientPayload $payload
     * @return array<string,string>
     */
    public static function createHeaders(
        ModelInterface $model,
        BunnyHttpClientPayload $payload,
    ): array {
        return array_filter(
            [
                ...array_merge(
                    $payload->headers,
                    ...$model->getHeaders(),
                ),
            ],
            fn ($value) => empty($value) === false,
        );
    }

    /**
     * @throws BunnyHttpClientResponseException
     * @throws BunnyJsonException
     * @return BunnyHttpClientResponseInterface
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public static function parseResponse(
        RequestInterface $request,
        ResponseInterface $response,
    ): BunnyHttpClientResponseInterface {
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode >= 400) {
            $body = (string) $response->getBody();

            throw new BunnyHttpClientResponseException($body, $statusCode);
        }

        try {
            $contents = $response->getBody()->getContents();

            // For non-json contents, e.g. binary for video download, return early without even validating.
            if ($request->getHeaderLine('Accept') === MimeType::ALL) {
                return new BunnyHttpClientResponse(
                    response: $response,
                    contents: $contents,
                );
            }

            if (self::isJson($contents) === true) {
                $contents = json_decode(
                    json: $contents,
                    associative: true,
                    flags: JSON_BIGINT_AS_STRING | JSON_THROW_ON_ERROR,
                );
            }
        } catch (Throwable $e) {
            throw new BunnyJsonException($e->getMessage().sprintf(' for "%s".', $request->getUri()), $e->getCode());
        }

        return new BunnyHttpClientResponse(
            response: $response,
            contents: $contents,
        );
    }

    /**
     * @throws BunnyJsonException
     * @return mixed
     * @param BunnyHttpClientPayload $payload
     */
    public static function createBody(BunnyHttpClientPayload $payload): mixed
    {
        $body = $payload->body;

        // Stream, binary, mixed, non-array content should be sent raw
        if (is_array($body) === false) {
            return $body;
        }

        try {
            $jsonBody = json_encode(
                value: $body,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (Throwable $e) {
            throw new BunnyJsonException(
                $e->getMessage(),
            );
        }

        return $jsonBody;
    }

    /**
     * @note Replace with json_validate in 8.3
     */
    private static function isJson(mixed $string): bool
    {
        json_decode($string);
        if (json_last_error() === JSON_ERROR_NONE) {
            return true;
        }

        return false;
    }
}
