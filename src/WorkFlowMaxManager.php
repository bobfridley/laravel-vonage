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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the workflowmax manager class.
 *
 * # workflowmax endpoints
 * https://api.workflowmax.com/job.api/appserver/rest/user/null (auth)
 * https://api.workflowmax.com/job.api/presence/rest/clicktocall/[phonenumber]
 * https://api.workflowmax.com/job.api/presence/rest/directory
 * https://api.workflowmax.com/job.api/presence/rest/extension/[extension-number]
 * https://api.workflowmax.com/job.api/presence/rest/callhistory/[extension number][?parameterlist]
 * https://api.workflowmax.com/job.api/presence/dashui[?filterExtension=[extensionlist]&firstRequest=true]
 * https://api.workflowmax.com/job.api/presence/rest/callrecording/[presenceCallId]
 * https://api.workflowmax.com/job.api/presence/rest/conference/[extension-number]
 * https://api.workflowmax.com/job.api/presence/rest/queue/[extension-number]
 *
 * @author BobFridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \BobFridley\WorkFlowMax\WorkFlowMaxFactory
     */
    protected $factory;

    /**
     * Create a new workflowmax manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository    $config
     * @param \BobFridley\WorkFlowMax\WorkFlowMaxFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, WorkFlowMaxFactory $factory)
    {
        parent::__construct($config);
        
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \WorkFlowMax\Client
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
        return 'workflowmax';
    }

    /**
     * Get the factory instance.
     *
     * @return \BobFridley\WorkFlowMax\WorkFlowMaxFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
