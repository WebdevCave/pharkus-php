<?php

namespace Webdevcave\Pharkus\Media\Converters;

use Exception;
use Webdevcave\Pharkus\Exceptions\DataConversionException;
use Webdevcave\Pharkus\Http\Message\Response;
use Webdevcave\Pharkus\Media\MediaConverterInterface;

class JsonConverter implements MediaConverterInterface
{
    /**
     * @inheritdoc
     */
    public function import(?string $body): array|null
    {
        if (is_null($body)) {
            return null;
        }

        $data = json_decode($body, true);

        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new DataConversionException(json_last_error_msg());
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function export(Response $response): string|null
    {
        $body = json_encode($response->getEntity());

        if ($body === false) {
            throw new DataConversionException(json_last_error_msg());
        }

        return $body;
    }

    /**
     * @inheritdoc
     */
    public function handle(Exception $exception): string|null
    {
        return json_encode(['message' => $exception->getMessage()]);
    }
}