<?php namespace PHPUnit\ParallelRunner;

use PHPUnit_TextUI_Command;
use PHPUnit_Util_Getopt;
use PHPUnit_Framework_Exception;

/**
 * A Parallel Command runner for CLI
 */
class PHPUnit_Parallel_Command extends PHPUnit_TextUI_Command
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
        return new PHPUnit_Parallel_TestRunner($this->arguments['loader']);
    }

    /**
     * {@inheritdoc}
     */
    protected function showHelp()
    {
        parent::showHelp();

        print <<<EOT

Parallel Options:

  --current-node <num>  The index of this node in the parallel cluster.
  --total-nodes  <num>  The total number of nodes in the parallel cluster.

EOT;
    }
}
