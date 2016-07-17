<?php
/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\Vonage\Facades;
use BobFridley\Vonage\VonageManager;
use BobFridley\Vonage\Facades\Vonage;
use BobFridley\TestBenchCore\FacadeTrait;
use BobFridley\Tests\Vonage\AbstractTestCase;
/**
 * This is the vonage facade test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class VonageTest extends AbstractTestCase
{
    use FacadeTrait;
    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'vonage';
    }
    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Vonage::class;
    }
    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return VonageManager::class;
    }
}