<?php
require_once 'Util.php';

/**
 * Classe Application
 * Responsável por controlar as requisições para a aplicação
 */
class Application {
	
	//Atributo estático, armazena as configurações do projeto
	public static $config;
	
	//Método construtor
	public function __construct($ini) {
		
		//Carrega o arquivo de configurações
		self::$config = parse_ini_file($ini, true);
		
		//Seta as diretivas do PHP
		if(!empty(self::$config['php'])) {
			foreach (self::$config['php'] AS $php_opcao => $php_valor){
				ini_set($php_opcao, $php_valor);
			}
		}
	}
	
	/**
	 * Método start()
	 * Responsável por inicializar a aplicação
	 */
	public function start() {
		//Tratamentos dos parâmetros da requisição
		$request_uri = strtolower(str_replace("index.php", "", $_SERVER['REQUEST_URI']));
		$script_name = strtolower(str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));
		$request = str_replace($script_name, "", $request_uri);
		$request = rtrim($request, '/');
		
		if (!$request) $request = '/';
		
		define("URL_ACTION", $request);
		define("URL_BASE", "http://".$_SERVER['HTTP_HOST'].$script_name."/");
		
		require_once 'application/router.php';
		$router->render($request);
	}
}