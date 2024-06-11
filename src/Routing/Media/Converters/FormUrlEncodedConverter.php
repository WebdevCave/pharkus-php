<?php

namespace Webdevcave\Pharkus\Routing\Media\Converters;

use Exception;
use Webdevcave\Pharkus\Http\Message\Response;
use Webdevcave\Pharkus\Routing\Media\MediaConverterInterface;

class FormUrlEncodedConverter implements MediaConverterInterface
{

    /**
     * @inheritDoc
     */
    public function import(?string $body): array|null
    {
        if (is_null($body)) {
            return null;
        }

        $data = [];
        parse_str($body, $data);

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function export(Response $response): string|null
    {
        $entity = $response->getEntity();

        if (is_null($entity)) {
            return null;
        }

        return http_build_query($entity);
    }

    /**
     * @inheritDoc
     */
    public function handle(Exception $exception): string|null
    {
        return $exception->getMessage();
    }
}
