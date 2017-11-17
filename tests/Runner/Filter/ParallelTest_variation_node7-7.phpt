--TEST--
Test Parallel Filter for 7th of 7 Nodes
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = '--current-node=6';
$_SERVER['argv'][4] = '--total-nodes=7';
$_SERVER['argv'][5] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

Command::main();

--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


Starting test 'BasicTest::testBasic7'.
.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
