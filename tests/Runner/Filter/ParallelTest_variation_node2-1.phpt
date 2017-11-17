--TEST--
Test Parallel Filter for 1st of 2 Nodes
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = '--current-node=0';
$_SERVER['argv'][4] = '--total-nodes=2';
$_SERVER['argv'][5] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

Command::main();

--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


Starting test 'BasicTest::testBasic1'.
.
Starting test 'BasicTest::testBasic3'.
.
Starting test 'BasicTest::testBasic5'.
.
Starting test 'BasicTest::testBasic7'.
.
Starting test 'BasicTest::testBasic9'.
.
Starting test 'BasicTest::testBasic11'.
.                                                              6 / 6 (100%)

Time: %s ms, Memory: %s

OK (6 tests, 6 assertions)
