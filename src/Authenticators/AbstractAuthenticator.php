<?php

/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\Vonage\Authenticators;

use GuzzleHttp\Client;

/**
 * This is the abstract authenticator class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
abstract class AbstractAuthenticator
{
    /**
     * The client to perform the authentication on.
     *
     * @var \GuzzleHttp\Client|null
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return \BobFridley\Vonage\Authenticators\AuthenticatorInterface
     */
    public function with(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
