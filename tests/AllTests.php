<?php
if (! defined ( 'PHPUnit_MAIN_METHOD' )) {
	define ( 'PHPUnit_MAIN_METHOD', 'AllTests::main' );
}
// require_once 'TestHelper.php';
require_once ('/var/www/project/vendor/autoload.php');
require_once ('/var/www/project/library/ZFExt/Model/Entity.php');
require_once ('/var/www/project/library/ZFExt/Model/Author.php');
require_once ('/var/www/project/library/ZFExt/Model/Entry.php');
require_once ('/var/www/project/library/ZFExt/Model/EntryMapper.php');
require_once ('/var/www/project/library/ZFExt/Model/AuthorMapper.php');

require_once 'ZFExt/Model/AllTests.php';
class AllTests {
	public static function main() {
		PHPUnit_TextUI_TestRunner::run ( self::suite () );
	}
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite ( 'ZFSTDE Blog Suite' );
		$suite->addTest ( ZFExt_Model_AllTests::suite () );
		return $suite;
	}
}
if (PHPUnit_MAIN_METHOD == 'AllTests::main') {
	AllTests::main ();
}