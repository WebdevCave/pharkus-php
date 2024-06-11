<?php

namespace Webdevcave\Pharkus\Routing\Media;

enum MediaType: string
{
    case APPLICATION_FORM_URLENCODED = 'application/x-www-form-urlencoded';
    case APPLICATION_JSON = 'application/json';
    case TEXT_XML = 'text/xml';
}
