<?php namespace DigitalRonin\CleverReach\Classes;
/**
 * Created by PhpStorm.
 * User: danielbruni
 * Date: 22.08.16
 * Time: 15:55
 */

use GuzzleHttp\Client;

class CleverReach_REST
{
    public $apiBaseUri = 'https://rest.cleverreach.com/v1';

    /**
     * CleverReach Login Credentials
     * TODO: Replace with OAuth
     *
     * @var int     CleverReach Client ID
     * @var string  CleverReach Login
     * @var string  CleverReach Password
     */
    private $clientId;
    private $login;
    private $password;

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * @var
     */
    private $headers;

    /**
     * CleverReach constructor.
     * @param int $CleverreachClientId Client-ID
     * @param string $CleverreachLogin CleverReach login name
     * @param string $CleverreachPassword CleverReach Password
     */
    public function __construct($CleverreachClientId, $CleverreachLogin, $CleverreachPassword)
    {
        $this->clientId = $CleverreachClientId;
        $this->login = $CleverreachLogin;
        $this->password = $CleverreachPassword;

        // Create a client and provide a base URL
        $this->httpClient = new Client(['base_uri' => $this->apiBaseUri]);
        $this->setHeaders();
    }

    /**
     * @return mixed
     */
    private function setToken()
    {
        $data = $this->httpClient->post('/login', [
            'json' => [
                'client_id' => $this->clientId,
                'login' => $this->login,
                'password' => $this->password
            ]
        ])->getBody();

        $token = \GuzzleHttp\json_decode($data);

        return $token;
    }

    /**
     *  Set Header for Bearer Token Auth
     */
    private function setHeaders()
    {
        $this->headers = [
            'headers' => [
                'Authorization' => "Bearer {$this->setToken()}"
            ]
        ];
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getGroups()
    {
        return $this->httpClient->get('/groups', $this->headers)->getBody();
    }

}