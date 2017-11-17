<?php

namespace PHPUnit\ParallelRunner;

use PHPUnit\Runner\Filter;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestSuite;

/**
 * A Parallel test runner for CLI
 */
class TestRunner extends \PHPUnit\TextUI\TestRunner
{
    const PARALLEL_ARG = 'parallelNodes';

    /**
     * Processes a potentially nested test suite based on various filters through the CLI.
     *
     * @param PHPUnit_Framework_TestSuite $suite     The suite to filter
     * @param array                       $arguments The CLI arguments
     */
    private function processSuiteFilters(TestSuite $suite, array $arguments)
    {
        if (empty($arguments['filter']) &&
            empty($arguments[self::PARALLEL_ARG]) &&
            empty($arguments['groups']) &&
            empty($arguments['excludeGroups'])) {
            return;
        }

        $filterFactory = new Filter\Factory();

        if (!empty($arguments['excludeGroups'])) {
            $filterFactory->addFilter(
                new \ReflectionClass('PHPUnit\Runner\Filter\Group\Exclude'),
                $arguments['excludeGroups']
            );
        }

        if (!empty($arguments['groups'])) {
            $filterFactory->addFilter(
                new \ReflectionClass('PHPUnit\Runner\Filter\Group\Include'),
                $arguments['groups']
            );
        }

        if (!empty($arguments['filter'])) {
            $filterFactory->addFilter(
                new \ReflectionClass('PHPUnit\Runner\Filter\Test'),
                $arguments['filter']
            );
        }

        if (!empty($arguments[self::PARALLEL_ARG])) {
            $filterFactory->addFilter(
                new \ReflectionClass('PhpUnit\Runner\Filter\Parallel'),
                $arguments[self::PARALLEL_ARG]
            );
        }

        $suite->injectFilter($filterFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function doRun(Test $suite, array $arguments = [], $exit = true)
    {
        $this->processSuiteFilters($suite, $arguments);

        return call_user_func_array(['parent', 'doRun'], func_get_args());
    }
}
