<?php

namespace Webdevcave\Pharkus\Routing\Media\Converters;

use Exception;
use RuntimeException;
use Webdevcave\Pharkus\Http\Message\Response;
use Webdevcave\Pharkus\Routing\Media\MediaConverterInterface;
use Webdevcave\Pharkus\Utils\ArrayUtil;

class XmlConverter implements MediaConverterInterface
{
    /**
     * @inheritDoc
     */
    public function import(?string $body): array|null
    {
        if (!function_exists('simplexml_load_string')) {
            throw new RuntimeException("XmlConverter requires PHP XML extension");
        }

        $xml = simplexml_load_string($body, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);

        return json_decode($json,TRUE);
    }

    /**
     * @inheritDoc
     */
    public function export(Response $response): string|null
    {
        //TODO implement
        throw new RuntimeException("Not implemented");
        //return $this->createElement($response->getEntity());
    }

    /**
     * @inheritDoc
     */
    public function handle(Exception $exception): string|null
    {
        return $this->createElement([
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
        ], get_class($exception));
    }

    /**
     * Used for array to xml conversion.
     *
     * @param mixed $data
     * @param string|null $element
     *
     * @return string
     */
    private function createElement(mixed $data, string $element = null): string
    {
        if (is_null($element)) {
            $element = is_array($data) ? 'response' : get_class($data);
        }

        if (is_object($data)) {
            $data = ArrayUtil::fromObject($data);
        }

        $buffer = "<$element";
        if (is_array($data)) {
            if(isset($data['@attributes'])) {
                foreach ($data['@attributes'] as $key => $value) {
                    $buffer .= " $key=\"$value\"";
                }

                unset($data['@attributes']);
            }

            if (empty($data)) {
                $buffer .= "/>";
                return $buffer;
            }

            $buffer .= ">";

            foreach ($data as $key => $value) {
                $buffer .= $this->createElement($value, $key);
            }
        } else {
            $buffer .= "><![CDATA[$data]]>";
        }
        $buffer .= "</$element>";

        return $buffer;
    }
}
