<?php

namespace Webdevcave\Pharkus\Utils;

class ArrayUtil
{
    /**
     * @param object $object
     * @param bool $deep
     *
     * @return array
     */
    public static function fromObject(object $object, bool $deep = true): array
    {
        if ($deep) {
            return json_decode(json_encode($object), true);
        }

        return (array) $object;
    }
}
