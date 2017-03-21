<?php
class IndexController extends Controller
{
	public function indexAction()
	{
		$this->view->assign("pagina", "Olá, seja bem-vindo!");
		$this->view->display("index.html");
	}
	
	public function testAction($params)
	{
		echo '<pre>';
		print_r($params);
		exit;
	}
}