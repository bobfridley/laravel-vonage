<?php
/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\WorkFlowMax;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use InvalidArgumentException;
/**
 * This is the workflowmax factory class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxFactory
{
    /**
     * [$base_uri description]
     * 
     * @var string
     */
    public $base_uri = 'https://api.workflowmax.com';

    /**
     * Make a new workflowmax client.
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
        if (!array_key_exists('apiKey', $config) || !array_key_exists('accountKey', $config)) {
            throw new InvalidArgumentException('The workflowmax client requires authentication.');
        }

        return array_only($config, ['apiKey', 'accountKey']);
    }
    
    /**
     * Get the workflowmax client.
     *
     * @param string[] $auth
     *
     * @return \WorkFlowMax\Client
     */
    protected function getClient(array $auth)
    {
        $this->client = new Client(array('base_uri' => $this->base_uri));
        $this->cookie = new CookieJar();

        $response = $this->client->get($this->base_uri . '/job.api', [
            'cookies' => $this->cookie,
            'query' => [
                'apiKey' => $auth['apiKey'],
                'accountKey' => $auth['accountKey']
            ],
            'headers' => ['X-WorkFlowMax' => 'workflowmax']
        ]);

        return $this->client;
    }
}