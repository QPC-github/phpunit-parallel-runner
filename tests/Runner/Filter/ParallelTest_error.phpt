--TEST--
Test Parallel Filter for Invalid Values
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = '--current-node=1';
$_SERVER['argv'][4] = '--total-nodes=1';
$_SERVER['argv'][5] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

try {
    Command::main(false);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}

--EXPECTF--
Current node must be greater than or equal to 0, but less than or equal to total nodes!
