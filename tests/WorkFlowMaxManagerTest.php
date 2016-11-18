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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;

/**
 * This is the workflowmax manager test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];
        $manager = $this->getManager($config);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('workflowmax.default')->andReturn('workflowmax');
        $this->assertSame([], $manager->getConnections());
        $return = $manager->connection();
        $this->assertInstanceOf('WorkFlowMax\Client', $return);
        $this->assertArrayHasKey('workflowmax', $manager->getConnections());
    }
    
    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(WorkFlowMaxFactory::class);
        $manager = new WorkFlowMaxManager($repo, $factory);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('workflowmax.connections')->andReturn(['workflowmax' => $config]);
        $config['name'] = 'workflowmax';
        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));
        return $manager;
    }
}