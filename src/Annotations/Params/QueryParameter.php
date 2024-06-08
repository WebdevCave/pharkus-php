<?php

namespace Webdevcave\Pharkus\Annotations\Params;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class QueryParameter
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $validator,
    )
    {
    }
}
