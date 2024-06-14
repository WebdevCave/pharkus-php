<?php

namespace Webdevcave\Pharkus\Annotations\Injection;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class Inject
{
    public function __construct(
        public readonly ?string $name = null
    )
    {
    }
}
