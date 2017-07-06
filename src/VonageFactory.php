<?php
/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Vonage;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;
use InvalidArgumentException;

/**
 * This is the vonage factory class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageFactory
{
    /**
     * [$base_uri description]
     * 
     * @var string
     */
    protected $base_uri = 'https://my.vonagebusiness.com';

    /**
     * [$cookie description]
     * @var \GuzzleHttp\Cookie\CookieJar
     */
    private $cookie;

    /**
     * [$cookieFile description]
     * @var string
     */
    private $cookieFile;

    /**
     * [$cookieJar description]
     * @var GuzzleHttp\Cookie\FileCookieJar
     */
    private $cookieJar;

    /**
     * Make a new vonage client.
     *
     * @param array[] $config
     *
     * @return \GuzzleHttp\Client
     */
    
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }
    
    /**
     * Get the configuration data.
     *
     * @param array[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('username', $config) || !array_key_exists('password', $config)) {
            throw new InvalidArgumentException('The vonage client requires authentication.');
        }

        return array_only($config, ['username', 'password']);
    }
    
    /**
     * Get the vonage client.
     *
     * @param array[] $auth
     *
     * @return \Vonage\Client
     */
    protected function getClient(array $auth)
    {
        $this->cookieFile = storage_path() . '/guzzlehttp/cookies/vonage/' . $auth['username'] . '.txt';

        $cookieJar = new FileCookieJar($this->cookieFile, true);

        $this->client = new Client(array('base_uri' => $this->base_uri, 'cookies' => $cookieJar));

        $response = $this->client->get($this->base_uri . '/appserver/rest/user/null', [
            'cookies' => $cookieJar,
            'query' => [
                'htmlLogin' => $auth['username'],
                'htmlPassword' => $auth['password']
            ],
            'headers' => ['X-Vonage' => 'vonage']
        ]);

        return $this->client;
    }
}