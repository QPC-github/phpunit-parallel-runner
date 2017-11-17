<?php namespace PHPunit\ParallelRunner\Tests;

use Exception;
use PHPUnit\ParallelRunner\Command;
use PHPUnit\ParallelRunner\TestRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

class CommandTest extends TestCase {
    /**
     * @param $class
     * @param $method
     * @return \ReflectionMethod
     */
    private function getHiddenMethod($class, $method) {
        $r = new ReflectionClass($class);
        $f = $r->getMethod($method);
        $f->setAccessible(true);

        return $f;
    }

    /**
     * @param callable $trigger
     * @return string
     */
    private function getStdOut(callable $trigger) {
        // start output buffering
        ob_start();

        // display the help
        $trigger();

        // capture the output
        $output = ob_get_contents();

        // clean the stdout buffer
        ob_end_clean();

        return $output;
    }

    /**
     *
     */
    public function testCreateRunnerReturnsParallelRunner() {
        $cmd = new Command();
        $f = $this->getHiddenMethod(get_class($cmd), 'createRunner');

        $this->assertInstanceOf(TestRunner::class, $f->invokeArgs($cmd, []));
    }

    public function testHelpShowsParallelParameters()
    {
        $cmd = new Command();
        $f = $this->getHiddenMethod(get_class($cmd), 'showHelp');

        $help = $this->getStdOut(function() use ($cmd, $f) {
            $f->invokeArgs($cmd, []);
        });

        $this->assertContains('--current-node', $help);
        $this->assertContains('--total-nodes', $help);
    }

    /**
     * @return array
     */
    public function singleParameterProvider() {
        return [
            [['--current-node=0']],
            [['--total-nodes=1']],
        ];
    }

    /**
     * @dataProvider singleParameterProvider
     */
    public function testCmdFailsWhenBothParamsAreNotProvided($args) {
        $cmd = new Command();
        $f = $this->getHiddenMethod(get_class($cmd), 'handleArguments');

        try {
            $f->invokeArgs($cmd, [$args]);
            $this->expectException(RuntimeException::class);
        } catch (Exception $e) {
            $this->assertInstanceOf(RuntimeException::class, $e);
            $this->assertContains('Both --current-node and --total-nodes are required for parallelism', $e->getMessage());
        }
    }
}
