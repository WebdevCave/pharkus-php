<?php

namespace Webdevcave\Pharkus\Annotations\Routing\Params;

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
