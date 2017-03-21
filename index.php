<?php
header('Content-type: text/html; charset=utf-8');

//Força exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Define o caminho real para o diretório da aplicação
define('PAINEL_PATH', dirname(__FILE__));
define('APPLICATION_PATH', PAINEL_PATH . DIRECTORY_SEPARATOR . 'application');

//Seta os caminhos para o include_path do PHP
set_include_path(implode(PATH_SEPARATOR, array(
	APPLICATION_PATH,
	APPLICATION_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR,
	APPLICATION_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR,
	APPLICATION_PATH . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR,
// 	APPLICATION_PATH . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Smarty' . DIRECTORY_SEPARATOR . 'sysplugins' . DIRECTORY_SEPARATOR,
// 	APPLICATION_PATH . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Smarty' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR,
	get_include_path()
)));

//Habilita o carregamento automático de Classes
function __autoload($class_name){
	if (substr($class_name, 0, 15) == "Smarty_Internal") {
		$class_name = "Smarty/sysplugins/" . strtolower($class_name);
	}
	
	require_once $class_name . '.php';
}

//Inicia a aplicação
$application = new Application(
	APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'application.ini'
);

$application->start();