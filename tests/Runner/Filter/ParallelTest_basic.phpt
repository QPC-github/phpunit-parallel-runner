--TEST--
Test Parallel Filter when No Args Provided
--FILE--
<?php
use PHPUnit\ParallelRunner\Command;

// $_SERVER['argv'][0] = 'phpunit'; // this will be set by the shell
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = __DIR__ . '/_files/BasicTestFile.php';

$dir = $_SERVER['PWD'];
require_once($dir . '/vendor/autoload.php');

Command::main();

--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


Starting test 'BasicTest::testBasic1'.
.
Starting test 'BasicTest::testBasic2'.
.
Starting test 'BasicTest::testBasic3'.
.
Starting test 'BasicTest::testBasic4'.
.
Starting test 'BasicTest::testBasic5'.
.
Starting test 'BasicTest::testBasic6'.
.
Starting test 'BasicTest::testBasic7'.
.
Starting test 'BasicTest::testBasic8'.
.
Starting test 'BasicTest::testBasic9'.
.
Starting test 'BasicTest::testBasic10'.
.
Starting test 'BasicTest::testBasic11'.
.
Starting test 'BasicTest::testBasic12'.
.                                                      12 / 12 (100%)

Time: %s ms, Memory: %s

OK (12 tests, 12 assertions)
