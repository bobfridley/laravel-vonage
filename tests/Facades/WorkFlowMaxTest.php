<?php
/*
 * This file is part of Laravel WorkFlowMax.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\WorkFlowMax\Facades;
use BobFridley\WorkFlowMax\WorkFlowMaxManager;
use BobFridley\WorkFlowMax\Facades\WorkFlowMax;
use BobFridley\TestBenchCore\FacadeTrait;
use BobFridley\Tests\WorkFlowMax\AbstractTestCase;
/**
 * This is the workflowmax facade test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class WorkFlowMaxTest extends AbstractTestCase
{
    use FacadeTrait;
    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'workflowmax';
    }
    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return WorkFlowMax::class;
    }
    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return WorkFlowMaxManager::class;
    }
}