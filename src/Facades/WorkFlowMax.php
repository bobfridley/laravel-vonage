<?php

/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\WorkFlowMax\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the workflowmax facade class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMax extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'workflowmax';
    }
}
