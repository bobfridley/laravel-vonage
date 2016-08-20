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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the vonage manager class.
 *
 * # vonage endpoints
 * https://my.vonagebusiness.com/appserver/rest/user/null (auth)
 * https://my.vonagebusiness.com/presence/rest/clicktocall/[phonenumber]
 * https://my.vonagebusiness.com/presence/rest/directory
 * https://my.vonagebusiness.com/presence/rest/extension/[extension-number]
 * https://my.vonagebusiness.com/presence/rest/callhistory/[extension number][?parameterlist]
 * https://my.vonagebusiness.com/presence/dashui[?filterExtension=[extensionlist]&firstRequest=true]
 * https://my.vonagebusiness.com/presence/rest/callrecording/[presenceCallId]
 * https://my.vonagebusiness.com/presence/rest/conference/[extension-number]
 * https://my.vonagebusiness.com/presence/rest/queue/[extension-number]
 *
 * @author BobFridley <robert.fridley@gmail.com>
 */
class VonageManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \BobFridley\Vonage\VonageFactory
     */
    protected $factory;

    /**
     * Create a new vonage manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \BobFridley\Vonage\VonageFactory        $factory
     *
     * @return void
     */
    public function __construct(Repository $config, VonageFactory $factory)
    {
        parent::__construct($config);
        
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Vonage\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'vonage';
    }

    /**
     * Get the factory instance.
     *
     * @return \BobFridley\Vonage\VonageFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
