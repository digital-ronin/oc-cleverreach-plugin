<?php namespace DigitalRonin\CleverReach\Classes;

class CleverReach_Api {
    private $client;

    /**
     * @param string $wsdlUrl
     */
    public function __construct($wsdlUrl) {
        $this->client = new \SoapClient($wsdlUrl);
    }

    /**
     * @return \SoapClient
     */
    public function getClient() {
        return $this->client;
    }
}

class CleverReach
{
    /**
     * CleverReach API-Key
     */
    private $apiKey;

    /**
     * CleverReach SOAP WSDL-URL
     */
    private $wsdlUrl = "http://api.cleverreach.com/soap/interface_v5.1.php?wsdl";

    /**
     * @var
     */
    private $api;

    var $errorMessage;

    /**
     * CleverReach constructor.
     * @param $api_key
     */
    public function __construct($api_key)
    {
        $this->apiKey = $api_key;
    }

    /**
     * @return \SoapClient
     */
    private function getApi()
    {
        if (is_null($this->api)) {
            $this->api = new CleverReach_Api($this->wsdlUrl);
        }

        return $this->api->getClient();
    }

    /**
     * @param bool $raw
     * @return mixed
     */
    public function getGroups($raw = false)
    {
        $groups = $this->getApi()->groupGetList($this->apiKey);

        if ($raw) {
            return $groups;
        }

        return $groups->data;
    }

    /**
     * Subscribe the provided email to a list
     *
     * @param string $formId the form id to connect to
     * @param string $email the email address to subscribe
     * @return boolean
     */
    public function listSubscribe($formId, $email)
    {
        $user = array();
        $user["email"] = $email;
        $user["registered"] = time();
        $user["activated"] = time();

        $result = $this->getApi()->receiverAdd($this->apiKey, $formId, $user);

        if ($result->status=="SUCCESS") {
            //Successful list call
            return true;
        } else {
            //lists call failed
            $this->errorMessage = $result->message;
            return false;
        }
    }

    /**
     *
     * @param integer $formId
     * @param string $email
     * @param array $doidata
     * @return array
     */
    public function sendActivationMail($formId, $email, array $doidata = array())
    {
        return $this->getApi()->formsSendActivationMail($this->apiKey, $formId, $email, $doidata);
    }

    /**
     *
     * @param integer $formId
     * @param string $email
     * @return array
     */
    public function sendUnsubscribeMail($formId, $email)
    {
        return $this->getApi()->formsSendUnsubscribeMail($this->apiKey, $formId, $email);
    }
}
