<?php

namespace Centum\Http;

enum Status: int
{
    case CONTINUE                        = 100;
    case SWITCHING_PROTOCOLS             = 101;
    case PROCESSING                      = 102;
    case EARLY_HINTS                     = 103;
    case OK                              = 200;
    case CREATED                         = 201;
    case ACCEPTED                        = 202;
    case NONAUTHORITATIVE_INFORMATION    = 203;
    case NO_CONTENT                      = 204;
    case RESET_CONTENT                   = 205;
    case PARTIAL_CONTENT                 = 206;
    case MULTISTATUS                     = 207;
    case ALREADY_REPORTED                = 208;
    case IM_USED                         = 226;
    case MULTIPLE_CHOICES                = 300;
    case MOVED_PERMANENTLY               = 301;
    case FOUND                           = 302;
    case SEE_OTHER                       = 303;
    case NOT_MODIFIED                    = 304;
    case USE_PROXY                       = 305;
    case TEMPORARY_REDIRECT              = 307;
    case PERMANENT_REDIRECT              = 308;
    case BAD_REQUEST                     = 400;
    case UNAUTHORIZED                    = 401;
    case PAYMENT_REQUIRED                = 402;
    case FORBIDDEN                       = 403;
    case NOT_FOUND                       = 404;
    case METHOD_NOT_ALLOWED              = 405;
    case NOT_ACCEPTABLE                  = 406;
    case PROXY_AUTHENTICATION_REQUIRED   = 407;
    case REQUEST_TIMEOUT                 = 408;
    case CONFLICT                        = 409;
    case GONE                            = 410;
    case LENGTH_REQUIRED                 = 411;
    case PRECONDITION_FAILED             = 412;
    case PAYLOAD_TOO_LARGE               = 413;
    case URI_TOO_LONG                    = 414;
    case UNSUPPORTED_MEDIA_TYPE          = 415;
    case RANGE_NOT_SATISFIABLE           = 416;
    case EXPECTATION_FAILED              = 417;
    case MISDIRECTED_REQUEST             = 421;
    case UNPROCESSABLE_ENTITY            = 422;
    case LOCKED                          = 423;
    case FAILED_DEPENDENCY               = 424;
    case TOO_EARLY                       = 425;
    case UPGRADE_REQUIRED                = 426;
    case PRECONDITION_REQUIRED           = 428;
    case TOO_MANY_REQUESTS               = 429;
    case REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    case UNAVAILABLE_FOR_LEGAL_REASONS   = 451;
    case INTERNAL_SERVER_ERROR           = 500;
    case NOT_IMPLEMENTED                 = 501;
    case BAD_GATEWAY                     = 502;
    case SERVICE_UNAVAILABLE             = 503;
    case GATEWAY_TIMEOUT                 = 504;
    case HTTP_VERSION_NOT_SUPPORTED      = 505;
    case VARIANT_ALSO_NEGOTIATES         = 506;
    case INSUFFICIENT_STORAGE            = 507;
    case LOOP_DETECTED                   = 508;
    case NOT_EXTENDED                    = 510;
    case NETWORK_AUTHENTICATION_REQUIRED = 511;



    /**
     * @return positive-int
     */
    public function getCode(): int
    {
        return $this->value;
    }

    /**
     * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     */
    public function getText(): string
    {
        return match ($this) {
            Status::CONTINUE                        => "Continue",
            Status::SWITCHING_PROTOCOLS             => "Switching Protocols",
            Status::PROCESSING                      => "Processing",
            Status::EARLY_HINTS                     => "Early Hints",
            Status::OK                              => "OK",
            Status::CREATED                         => "Created",
            Status::ACCEPTED                        => "Accepted",
            Status::NONAUTHORITATIVE_INFORMATION    => "Non-Authoritative Information",
            Status::NO_CONTENT                      => "No Content",
            Status::RESET_CONTENT                   => "Reset Content",
            Status::PARTIAL_CONTENT                 => "Partial Content",
            Status::MULTISTATUS                     => "Multi-Status",
            Status::ALREADY_REPORTED                => "Already Reported",
            Status::IM_USED                         => "IM Used",
            Status::MULTIPLE_CHOICES                => "Multiple Choices",
            Status::MOVED_PERMANENTLY               => "Moved Permanently",
            Status::FOUND                           => "Found",
            Status::SEE_OTHER                       => "See Other",
            Status::NOT_MODIFIED                    => "Not Modified",
            Status::USE_PROXY                       => "Use Proxy",
            Status::TEMPORARY_REDIRECT              => "Temporary Redirect",
            Status::PERMANENT_REDIRECT              => "Permanent Redirect",
            Status::BAD_REQUEST                     => "Bad Request",
            Status::UNAUTHORIZED                    => "Unauthorized",
            Status::PAYMENT_REQUIRED                => "Payment Required",
            Status::FORBIDDEN                       => "Forbidden",
            Status::NOT_FOUND                       => "Not Found",
            Status::METHOD_NOT_ALLOWED              => "Method Not Allowed",
            Status::NOT_ACCEPTABLE                  => "Not Acceptable",
            Status::PROXY_AUTHENTICATION_REQUIRED   => "Proxy Authentication Required",
            Status::REQUEST_TIMEOUT                 => "Request Timeout",
            Status::CONFLICT                        => "Conflict",
            Status::GONE                            => "Gone",
            Status::LENGTH_REQUIRED                 => "Length Required",
            Status::PRECONDITION_FAILED             => "Precondition Failed",
            Status::PAYLOAD_TOO_LARGE               => "Payload Too Large",
            Status::URI_TOO_LONG                    => "URI Too Long",
            Status::UNSUPPORTED_MEDIA_TYPE          => "Unsupported Media Type",
            Status::RANGE_NOT_SATISFIABLE           => "Range Not Satisfiable",
            Status::EXPECTATION_FAILED              => "Expectation Failed",
            Status::MISDIRECTED_REQUEST             => "Misdirected Request",
            Status::UNPROCESSABLE_ENTITY            => "Unprocessable Entity",
            Status::LOCKED                          => "Locked",
            Status::FAILED_DEPENDENCY               => "Failed Dependency",
            Status::TOO_EARLY                       => "Too Early",
            Status::UPGRADE_REQUIRED                => "Upgrade Required",
            Status::PRECONDITION_REQUIRED           => "Precondition Required",
            Status::TOO_MANY_REQUESTS               => "Too Many Requests",
            Status::REQUEST_HEADER_FIELDS_TOO_LARGE => "Request Header Fields Too Large",
            Status::UNAVAILABLE_FOR_LEGAL_REASONS   => "Unavailable For Legal Reasons",
            Status::INTERNAL_SERVER_ERROR           => "Internal Server Error",
            Status::NOT_IMPLEMENTED                 => "Not Implemented",
            Status::BAD_GATEWAY                     => "Bad Gateway",
            Status::SERVICE_UNAVAILABLE             => "Service Unavailable",
            Status::GATEWAY_TIMEOUT                 => "Gateway Timeout",
            Status::HTTP_VERSION_NOT_SUPPORTED      => "HTTP Version Not Supported",
            Status::VARIANT_ALSO_NEGOTIATES         => "Variant Also Negotiates",
            Status::INSUFFICIENT_STORAGE            => "Insufficient Storage",
            Status::LOOP_DETECTED                   => "Loop Detected",
            Status::NOT_EXTENDED                    => "Not Extended",
            Status::NETWORK_AUTHENTICATION_REQUIRED => "Network Authentication Required",
        };
    }



    public function isRedirect(): bool
    {
        return $this->getCode() >= 300 && $this->getCode() <= 399;
    }



    public function getHeaderString(): string
    {
        return sprintf(
            "HTTP/1.0 %d %s",
            $this->getCode(),
            $this->getText()
        );
    }



    public function send(): void
    {
        header(
            $this->getHeaderString(),
            true,
            $this->getCode()
        );
    }
}
