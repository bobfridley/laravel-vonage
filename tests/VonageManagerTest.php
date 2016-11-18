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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
/**
 * This is the vonage manager test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];
        $manager = $this->getManager($config);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('vonage.default')->andReturn('vonage');
        $this->assertSame([], $manager->getConnections());
        $return = $manager->connection();
        $this->assertInstanceOf('Vonage\Client', $return);
        $this->assertArrayHasKey('vonage', $manager->getConnections());
    }
    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(VonageFactory::class);
        $manager = new VonageManager($repo, $factory);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('vonage.connections')->andReturn(['vonage' => $config]);
        $config['name'] = 'vonage';
        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));
        return $manager;
    }
}