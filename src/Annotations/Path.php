<?php

namespace Webdevcave\Pharkus\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class Path
{
    public function __construct(
        public readonly string $path
    )
    {
    }
}
