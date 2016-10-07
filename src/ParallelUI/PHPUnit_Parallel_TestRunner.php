<?php namespace PHPUnit\ParallelRunner;

use PHPUnit_TextUI_TestRunner;
use PHPUnit_Framework_Test;

/**
 * A Parallel test runner for CLI
 */
class PHPUnit_Parallel_TestRunner extends PHPUnit_TextUI_TestRunner
{
    private $thisNode;
    private $totalNodes;

    /**
     * {@inheritdoc}
     */
    public function doRun(PHPUnit_Framework_Test $suite, array $arguments = [], $exit = true)
    {
        call_user_func_array(['parent', __FUNCTION__], func_get_args());
    }
}
