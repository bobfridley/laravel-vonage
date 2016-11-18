<?php

/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\WorkFlowMax\Authenticators;

use InvalidArgumentException;

/**
 * This is the password authenticator class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class PasswordAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \GuzzleHttp\Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the password authenticator.');
        }

        if (!array_key_exists('apiKey', $config) || !array_key_exists('accountKey', $config)) {
            throw new InvalidArgumentException('The password authenticator requires an apiKey and accountKey.');
        }

        $this->client->authenticate($config['accountKey'], $config['accountKey'], 'http_password');

        return $this->client;
    }
}
