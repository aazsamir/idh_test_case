<?php

namespace App\Enums;

enum HttpStatus: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case ERROR = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case ERROR_VALIDATION = 422;
    case INTERNAL_SERVER_ERROR = 500;
}
