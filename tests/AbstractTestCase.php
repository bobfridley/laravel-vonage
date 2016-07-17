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
use BobFridley\Vonage\VonageServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;
/**
 * This is the abstract test case class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return VonageServiceProvider::class;
    }
}