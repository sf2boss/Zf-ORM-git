<?php
namespace Sflib;
class Error
{
	
	public static function handleException($e) 
	{
		echo "Erreur dans l'application !";
		//print_r ($e->getMessage());
	}
	public static function handleError($errno,$errstr,$errfile,$errline,$context) {
		echo "Erreur ".$errno. ": ".$errstr. " <br />Fichier :".$errfile." ligne ".$errline."<br />";
		echo $context;	
	}
	
}