<?php

namespace Hazbo\Component\Http;

/**
 * Url processor for futures
 *
 * TODO: Improve validation methods to reduce code
 * 		 in future classes
 *
 * @group futures
 */
class UrlProcessor
{
	protected $url;
	protected $urlParts;

	public function __construct($url = "")
	{
		$this->url = $url;
	}

	/**
	 * Taken from initial URL passed through to
	 * feature
	 *
	 * @param string url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Get the protected url property
	 *
	 * @return string url
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Return the parts of the URL once they
	 * have been parsed after validate method
	 * had been called
	 *
	 * @return array url parts
	 */
	public function getUrlParts()
	{
		return $this->urlParts;
	}

	/**
	 * Call all validation methods,
	 * exceptions will be thrown if
	 * there are any issues
	 */
	public function validateForHttpFuture()
	{
		$this->urlParts = parse_url($this->url);
		$this->validateScheme();
		$this->validateHost();
		$this->validateHttpBasicAuth();
	}

	/**
	 * Validates the URL scheme
	 *
	 * @return bool
	 */
	private function validateScheme()
	{
		$scheme = $this->urlParts['scheme'];
        if (empty($scheme) || $scheme !== 'http') {
            throw new \Exception("
            	URI '{$this->uri}' must be fully qualified with 'http://' scheme."
            );
        }
        return true;
	}

	/**
	 * Validates the URL host
	 *
	 * @return bool
	 */
	private function validateHost()
	{
        if (!isset($this->urlParts['host'])) {
            throw new \Exception(
            	"URI '{$this->uri}' must be fully qualified and include host name."
            );
        }
        return true;
	}

	/**
	 * Validates against basic auth
	 * (Not supported using HttpFuture)
	 *
	 * @return bool
	 */
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