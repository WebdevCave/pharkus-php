<?php

namespace Webdevcave\Pharkus\Annotations\Params;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class PathParameter
{
    public function __construct(
        public string $name,
        public ?string $validator = null,
    )
    {
    }
}
