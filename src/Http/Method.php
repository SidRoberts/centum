<?php

namespace Centum\Http;

enum Method: string
{
    case GET     = "GET";
    case POST    = "POST";
    case HEAD    = "HEAD";
    case PUT     = "PUT";
    case DELETE  = "DELETE";
    case TRACE   = "TRACE";
    case OPTIONS = "OPTIONS";
    case CONNECT = "CONNECT";
    case PATCH   = "PATCH";
}
