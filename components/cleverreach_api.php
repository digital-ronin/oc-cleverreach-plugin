<?php namespace Digitalronin\Cleverreach\Components;

class Cleverreach_Api {
	private $client;  ///< SoapClient

	/**
	 * @param string $wsdlUrl
	 */
	public function __construct($wsdlUrl) {
		$this->client = new SoapClient($wsdlUrl);
	}

	/**
	 * @return SoapClient
	 */
	public function getClient() {
		return $this->client;
	}
}
