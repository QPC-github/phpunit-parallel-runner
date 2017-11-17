<?php

namespace PHPUnit\ParallelRunner;

use PHPUnit\Util\Getopt;

/**
 * A Parallel Command runner for CLI
 */
class Command extends \PHPUnit\TextUI\Command
{
    public function __construct() {
        $this->longOptions += [
            'current-node=' => null,
            'total-nodes='  => null,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function createRunner()
    {
        return new TestRunner($this->arguments['loader']);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleArguments(array $argv)
    {
        try {
            $this->options = Getopt::getopt(
                $argv,
                'd:c:hv',
                array_keys($this->longOptions)
            );
        } catch (\PHPUnit\Framework\Exception $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        $this->arguments[TestRunner::PARALLEL_ARG] = [];

        foreach ($this->options[0] as $option) {
            switch ($option[0]) {
                case '--current-node':
                    $this->arguments[TestRunner::PARALLEL_ARG][0] = $option[1];
                    break;
                case '--total-nodes':
                    $this->arguments[TestRunner::PARALLEL_ARG][1] = $option[1];
                    break;
            }
        }

        if (count($this->arguments[TestRunner::PARALLEL_ARG]) == 0) {
            unset($this->arguments[TestRunner::PARALLEL_ARG]);
        } else if (count($this->arguments[TestRunner::PARALLEL_ARG]) != 2) {
            throw new \RuntimeException('Both --current-node and --total-nodes are required for parallelism');
        }

        parent::handleArguments($argv);
    }

    /**
     * {@inheritdoc}
     */
    protected function showHelp()
    {
        parent::showHelp();

        print <<<EOT

Parallel Options:

  --current-node <num>  The index of this node in the parallel cluster. Default 0.
  --total-nodes  <num>  The total number of nodes in the parallel cluster. Default 1.

EOT;
    }
}
