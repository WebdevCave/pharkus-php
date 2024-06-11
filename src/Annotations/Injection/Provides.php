<?php

namespace Webdevcave\Pharkus\Annotations\Injection;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Provides
{
    public function __construct(
        public readonly string $name
    )
    {
    }
}
