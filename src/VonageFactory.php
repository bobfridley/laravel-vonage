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
use GuzzleHttp\Cookie\CookieJar;
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
    public $base_uri = 'https://my.vonagebusiness.com';

    /**
     * Make a new vonage client.
     *
     * @param string[] $config
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
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
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
     * @param string[] $auth
     *
     * @return \Vonage\Client
     */
    protected function getClient(array $auth)
    {
        $this->client = new Client(array('base_uri' => $this->base_uri));
        $this->cookie = new CookieJar();

        $response = $this->client->get($this->base_uri . '/appserver/rest/user/null', [
            'cookies' => $this->cookie,
            'query' => [
                'htmlLogin' => $auth['username'],
                'htmlPassword' => $auth['password']
            ],
            'headers' => ['X-Vonage' => 'vonage']
        ]);

        return $this->client;
    }
}