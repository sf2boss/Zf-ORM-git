<?php
if (! defined ( 'PHPUnit_MAIN_METHOD' )) {
	define ( 'PHPUnit_MAIN_METHOD', 'ZFExt_Model_AllTests::main' );
}
// require_once 'TestHelper.php';
require_once 'ZFExt/Model/EntryTest.php';
require_once 'ZFExt/Model/AuthorTest.php';
require_once 'ZFExt/Model/EntryMapperTest.php';
require_once 'ZFExt/Model/AuthorMapperTest.php';
class ZFExt_Model_AllTests {
	public static function main() {
		PHPUnit_TextUI_TestRunner::run ( self::suite () );
	}
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite ( 'ZFSTDE Blog Suite: Models' );
		$suite->addTestSuite ( 'ZFExt_Model_EntryTest' );
		return $suite;
	}
}
if (PHPUnit_MAIN_METHOD == 'ZFExt_Model_AllTests::main') {
	ZFExt_Model_AllTests::main ();
}