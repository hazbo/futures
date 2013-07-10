<?php

namespace Hazbo\Component\Http;

/**
 * @group futures
 */
final class Status_HTTPFutureResponseStatusHTTP extends Status_HTTPFutureResponseStatus {

  private $excerpt;

  public function __construct($status_code, $body) {
    // NOTE: Avoiding phutil_utf8_shorten() here because this isn't lazy
    // and responses may be large.
    if (strlen($body) > 512) {
      $excerpt = substr($body, 0, 512).'...';
    } else {
      $excerpt = $body;
    }
    $this->excerpt = \Hazbo\Component\Utils\Utf8::phutil_utf8ize($excerpt);

    parent::__construct($status_code);
  }

  protected function getErrorCodeType($code) {
    return 'HTTP';
  }

  public function isError() {
    return ($this->getStatusCode() < 200) || ($this->getStatusCode() > 299);
  }

  public function isTimeout() {
    return false;
  }

  protected function getErrorCodeDescription($code) {
    static $map = array(
      404 => 'Not Found',
      500 => 'Internal Server Error',
    );

    return \Hazbo\Component\Utils\Utils::idx($map, $code)."\n".$this->excerpt."\n";
  }

}

