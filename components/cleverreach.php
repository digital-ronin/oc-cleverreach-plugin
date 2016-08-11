<?php namespace Digitalronin\Cleverreach\Components;

class Cleverreach
{
  private $apiKey;
  private $wsdlUrl;
  private $api;

  public function __construct()
  {
    $this->apiKey = $settings->api_key;
  }

  /**
   * @return SoapClient
   */
   private function getApi()
   {
     if (is_null($this->api)) {
       $this->api = new Cleverreach_Api($this->wsdlUrl);
     }

     return $this->api->getClient();
   }

  /**
   * @return array
   */
  public function getGroups($raw = false)
  {
    $groups = $this->getApi()->groupGetList($this->apiKey);

    if ($raw) {
      return $groups;
    }

    return $groups->data;
  }

}
