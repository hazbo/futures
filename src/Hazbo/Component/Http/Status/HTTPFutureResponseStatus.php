<?php

namespace Hazbo\Component\Http;

abstract class Status_HTTPFutureResponseStatus extends \Exception
{
    private
        $statusCode,
        $uri;

    public function __construct($status_code, $uri = null)
    {
        $this->statusCode = $status_code;
        $this->uri = (string)$uri;

        $type        = $this->getErrorCodeType($status_code);
        $description = $this->getErrorCodeDescription($status_code);

        $uri_info = '';
        if ($this->uri) {
            $uri_info = ' ('.$this->uri.')';
        }

        $message = rtrim("[{$type}/{$status_code}]{$uri_info} {$description}");

        parent::__construct($message);
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }

    final public function getURI()
    {
        return $this->uri;
    }

    abstract public function isError();
    abstract public function isTimeout();

    abstract protected function getErrorCodeType($code);
    abstract protected function getErrorCodeDescription($code);
}