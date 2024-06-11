<?php

namespace Webdevcave\Pharkus\Utils;

use Exception;
use Webdevcave\Pharkus\Exceptions\HydrationException;

class ObjectUtil
{
    /**
     * Create a new $class instance filled with values provided by $data.
     *
     * @template T
     *
     * @param T $class
     * @param object|array $data
     *
     * @return T
     *
     * @throws Exception
     * @throws HydrationException
     */
    public static function hydrate(mixed $class, object|array $data): object
    {
        //TODO: implement
        throw new Exception("Not implemented");
    }
}
