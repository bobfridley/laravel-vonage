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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
/**
 * This is the vonage factory test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getVonageFactory();
        $return = $factory->make(['token' => 'your-token', 'app' => 'your-app']);
        $this->assertInstanceOf(Client::class, $return);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The vonage client requires authentication.
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getVonageFactory();
        $factory->make(['app' => 'your-app']);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The vonage client requires authentication.
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getVonageFactory();
        $factory->make(['token' => 'your-token']);
    }
    protected function getVonageFactory()
    {
        return new VonageFactory();
    }
}