<?php
// CONSTANTE ZEND
define('DS', DIRECTORY_SEPARATOR);
define('APP_ENV', getenv('APPLICATION_ENV') ?: 'production');
define('ROOT_PATH', dirname(dirname(__DIR__)));
define('SRC_PATH', ROOT_PATH.DS.'src');
define('LIB_PATH', ROOT_PATH.DS.'library');
define('PUBLIC_PATH', SRC_PATH.DS.'public');
define('VENDOR_PATH', ROOT_PATH.DS.'vendor');
define('APP_PATH', SRC_PATH.DS.'application');

//CONSTANTE APPLI
define('APP_NAME', "Zf-ORM-git");

//require_once LIB_PATH.DS."sf2boss".DS."sflib".DS."Error.php";
require_once VENDOR_PATH.DS.'autoload.php';
if ('development' !== APP_ENV) {
	\php_error\reportErrors();
} else {
	set_exception_handler(array("Sflib\Error", "handleException"));
	set_error_handler(array("Sflib\Error", "handleError"));
}

$application = new Zend_Application(
		APP_ENV, 
		APP_PATH.DS.'core'.DS.'configs'.DS.'application.ini'
);

$application->bootstrap();
$application->run();

