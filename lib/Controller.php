<?php
require_once 'Smarty/Smarty.class.php';

class Controller
{
	//Objeto do Smarty - View
	protected $view;
	
	public function __construct()
	{
		//Instância da Engine de templates Smarty
		$this->view = new Smarty();
		//Seta o diretório das templates
		$this->view->setTemplateDir(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'templates');
		//Seta o diretório das templates compiladas
		$this->view->setCompileDir(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'templates_c');
		
		//Executa o "pseudo-construtor"
		$this->init();
	}

	/**
	 * Caso a controladora não tenha o método init()
	 * O PHP executa o init() da classe "pai"
	 */
	public function init() {}
	
	/**
	 * Método auxiliar para tratamento da resposta de retorno
	 */
	public function response_fallback($args)
	{
		//Respostas serão sempre no formato de array JSONP
		header('Content-Type: application/json');
	
		if (isset($_REQUEST['callback']))
			$callback = $_REQUEST['callback'];
		else
			$callback = 'jQueryDev';
	
		$response = array(
				'name' => 'response',
				'response' => $args
		);
		$response = $callback . '(' . json_encode($response) .');';
	
		die($response);
	}
}