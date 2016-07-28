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
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
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
        $return = $factory->make(['username' => 'your-username', 'password' => 'your-password']);
        $this->assertInstanceOf(Client::class, $return);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The vonage client requires authentication.
     */
    public function testMakeWithoutUsername()
    {
        $factory = $this->getVonageFactory();
        $factory->make(['password' => 'your-password']);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The vonage client requires authentication.
     */
    public function testMakeWithoutPassword()
    {
        $factory = $this->getVonageFactory();
        $factory->make(['password' => 'your-username']);
    }
    
    protected function getVonageFactory()
    {
        return new VonageFactory();
    }
}