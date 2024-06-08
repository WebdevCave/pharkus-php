<?php

namespace Webdevcave\Pharkus\Http\Message;

enum ResponseStatus: int
{
    case OK = 200;
    case REDIRECT = 301;
    case BAD_REQUEST = 400;
    case FORBIDDEN = 401;
    case UNAUTHORIZED = 403;
    case NOT_FOUND = 404;
    case IM_A_TEAPOT = 418;
}
