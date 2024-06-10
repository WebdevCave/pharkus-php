<?php

namespace Webdevcave\Pharkus\Annotations;

use Attribute;
use Webdevcave\Pharkus\Media\MediaType;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class Produces
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
