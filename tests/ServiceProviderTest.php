<?php
/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\Vonage;
use Vonage\Client;
use BobFridley\Vonage\VonageFactory;
use BobFridley\Vonage\VonageManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
/**
 * This is the service provider test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;
    public function testVonageFactoryIsInjectable()
    {
        $this->assertIsInjectable(VonageFactory::class);
    }
    public function testVonageManagerIsInjectable()
    {
        $this->assertIsInjectable(VonageManager::class);
    }
    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);
        $original = $this->app['vonage.connection'];
        $this->app['vonage']->reconnect();
        $new = $this->app['vonage.connection'];
        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}