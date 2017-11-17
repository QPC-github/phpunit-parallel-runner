--TEST--
Test Parallel Filter for 3rd of 5 Nodes
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = '--current-node=2';
$_SERVER['argv'][4] = '--total-nodes=5';
$_SERVER['argv'][5] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

Command::main();

--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


Starting test 'BasicTest::testBasic3'.
.
Starting test 'BasicTest::testBasic8'.
.                                                                  2 / 2 (100%)

Time: %s ms, Memory: %s

OK (2 tests, 2 assertions)
