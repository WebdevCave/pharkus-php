<?php

namespace Webdevcave\Pharkus\Annotations\Params;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class PathParameter
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $validator = null,
    )
    {
    }
}
