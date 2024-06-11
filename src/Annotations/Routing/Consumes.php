<?php

namespace Webdevcave\Pharkus\Annotations\Routing;

use Attribute;
use Webdevcave\Pharkus\Routing\Media\MediaType;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class Consumes
{
    public readonly string $mediaType;

    public function __construct(
        MediaType|string $mediaType
    )
    {
        if ($mediaType instanceof MediaType) {
            $mediaType = $mediaType->value;
        }

        $this->mediaType = $mediaType;
    }
}
