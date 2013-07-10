<?php

namespace Hazbo\Component\Http;

class UrlProcessor
{
	protected $url;
	protected $urlParts;

	public function __construct($url = "")
	{
		$this->url = $url;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getUrlParts()
	{
		return $this->urlParts;
	}

	public function validateForHttpFuture()
	{
		$this->urlParts = parse_url($this->url);
		$this->validateScheme();
		$this->validateHost();
		$this->validateHttpBasicAuth();
	}

	private function validateScheme()
	{
		$scheme = $this->urlParts['scheme'];
        if (empty($scheme) || $scheme !== 'http') {
            throw new \Exception("
            	URI '{$uri}' must be fully qualified with 'http://' scheme."
            );
        }
        return true;
	}

	private function validateHost()
	{
        if (!isset($this->urlParts['host'])) {
            throw new \Exception(
            	"URI '{$this->uri}' must be fully qualified and include host name."
            );
        }
        return true;
	}

	private function validateHttpBasicAuth()
	{
        if (isset($this->urlParts['user']) || isset($this->urlParts['pass'])) {
            throw new \Exception("
            	HTTP Basic Auth is not supported by HTTPFuture."
            );
        }
        return true;
	}
}