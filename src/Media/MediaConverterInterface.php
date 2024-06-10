<?php

namespace Webdevcave\Pharkus\Media;

use Exception;
use Webdevcave\Pharkus\Exceptions\DataConversionException;
use Webdevcave\Pharkus\Http\Message\Response;

interface MediaConverterInterface
{
    /**
     * Receive raw request body and translate to an array containing each field => value.
     *
     * @param string|null $body
     * @return array|null
     *
     * @throws DataConversionException
     */
    public function import(?string $body): array|null;

    /**
     * Translates a response object back to an output string (counterpart of 'import').
     *
     * @param Response $response
     * @return string|null
     * @throws DataConversionException
     */
    public function export(Response $response): string|null;

    /**
     * Convert an exception to a response body to output.
     *
     * @param Exception $exception
     * @return string|null
     */
    public function handle(Exception $exception): string|null;
}
