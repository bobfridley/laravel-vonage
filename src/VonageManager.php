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

use BobFridley\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the vonage manager class.
 *
 * @method \Github\Api\CurrentUser currentUser()
 * @method \Github\Api\CurrentUser me()
 * @method \Github\Api\Enterprise ent()
 * @method \Github\Api\Enterprise enterprise()
 * @method \Github\Api\GitData git()
 * @method \Github\Api\GitData gitData()
 * @method \Github\Api\Gists gist()
 * @method \Github\Api\Gists gists()
 * @method \Github\Api\Issue issue()
 * @method \Github\Api\Issue issues()
 * @method \Github\Api\Markdown markdown()
 * @method \Github\Api\Organization organization()
 * @method \Github\Api\Organization organizations()
 * @method \Github\Api\PullRequest pr()
 * @method \Github\Api\PullRequest pullRequest()
 * @method \Github\Api\PullRequest pullRequests()
 * @method \Github\Api\Repo repo()
 * @method \Github\Api\Repo repos()
 * @method \Github\Api\Repo repository()
 * @method \Github\Api\Repo repositories()
 * @method \Github\Api\Organization team()
 * @method \Github\Api\Organization teams()
 * @method \Github\Api\User user()
 * @method \Github\Api\User users()
 * @method \Github\Api\Authorizations authorization()
 * @method \Github\Api\Authorizations authorizations()
 * @method \Github\Api\Meta meta()
 * @method \Github\Api\ApiInterface api(string $name)
 * @method void authenticate(string $tokenOrLogin, string|null $password = null, string|null $authMethod = null)
 * @method void setEnterpriseUrl(string $enterpriseUrl)
 * @method \Github\HttpClient\HttpClientInterface getHttpClient()
 * @method void setHttpClient(\Github\HttpClient\HttpClientInterface $httpClient)
 * @method void clearHeaders()
 * @method void setHeaders(array $headers)
 * @method mixed getOption(string $name)
 * @method void setOption(string $name, mixed $value)
 * @method array getSupportedApiVersions()
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
