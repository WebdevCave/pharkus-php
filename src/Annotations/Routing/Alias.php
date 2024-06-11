<?php

namespace Webdevcave\Pharkus\Annotations\Routing;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class Alias
{
    public function __construct(
        public readonly string $alias
    )
    {
    }
}
