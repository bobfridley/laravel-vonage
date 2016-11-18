<?php
/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\WorkFlowMax;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use BobFridley\WorkFlowMax\WorkFlowMaxFactory;
use BobFridley\WorkFlowMax\WorkFlowMaxManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testWorkFlowMaxFactoryIsInjectable()
    {
        $this->assertIsInjectable(WorkFlowMaxFactory::class);
    }

    public function testWorkFlowMaxManagerIsInjectable()
    {
        $this->assertIsInjectable(WorkFlowMaxManager::class);
    }
    
    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['workflowmax.connection'];
        $this->app['workflowmax']->reconnect();
        $new = $this->app['workflowmax.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}