<?php

/*
 * This file is part of Laravel Vonage.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\Vonage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the vonage facade class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class Vonage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vonage';
    }
}
