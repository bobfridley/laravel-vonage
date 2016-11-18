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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

/**
 * This is the workflowmax factory test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getWorkFlowMaxFactory();
        $return = $factory->make(['apiKey' => 'your-api-key', 'accountKey' => 'your-account-key']);
        $this->assertInstanceOf(Client::class, $return);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The workflowmax client requires authentication.
     */
    public function testMakeWithoutUsername()
    {
        $factory = $this->getWorkFlowMaxFactory();
        $factory->make(['accountKey' => 'your-api-key']);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The workflowmax client requires authentication.
     */
    public function testMakeWithoutPassword()
    {
        $factory = $this->getWorkFlowMaxFactory();
        $factory->make(['accountKey' => 'your-account-key']);
    }
    
    protected function getWorkFlowMaxFactory()
    {
        return new WorkFlowMaxFactory();
    }
}