--TEST--
Test Parallel Filter for 3rd of 3 Nodes
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = '--current-node=2';
$_SERVER['argv'][4] = '--total-nodes=3';
$_SERVER['argv'][5] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

Command::main();

--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


Starting test 'BasicTest::testBasic3'.
.
Starting test 'BasicTest::testBasic6'.
.
Starting test 'BasicTest::testBasic9'.
.
Starting test 'BasicTest::testBasic12'.
.                                                                4 / 4 (100%)

Time: %s ms, Memory: %s

OK (4 tests, 4 assertions)
