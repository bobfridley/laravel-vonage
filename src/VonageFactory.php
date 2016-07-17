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
use Vonage\Client;
use InvalidArgumentException;
/**
 * This is the vonage factory class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageFactory
{
    /**
     * Make a new vonage client.
     *
     * @param string[] $config
     *
     * @return \Vonage\Client
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
        if (!array_key_exists('token', $config) || !array_key_exists('app', $config)) {
            throw new InvalidArgumentException('The vonage client requires authentication.');
        }
        return array_only($config, ['token', 'app']);
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
        return new Client($auth['token'], $auth['app']);
    }
}