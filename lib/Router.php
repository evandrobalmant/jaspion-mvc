<?php
class Router
{
	private static $_instance;
	private static $_urlpatterns = array();
	
	public static function getInstance()
	{
		if (self::$_instance === null)//don't check connection, check instance
		{
			self::$_instance = new Router();
		}
		return self::$_instance;
	}
	
	public function register($pattern, $controller, $action, $params = array())
	{
		self::$_urlpatterns[$pattern] = array('controller' => $controller, 'action' => $action, 'params' => $params);
	}
	
	public function render($pattern)
	{
		if (array_key_exists($pattern, self::$_urlpatterns)) {
			
			$toRender = self::$_urlpatterns[$pattern];
			
			$control = new $toRender['controller'];
			
			//Executa o método na classe correspondente
			call_user_func(array($control, $toRender['action']), $toRender['params']);
			
		} else {
			
			//Erro
			$control = new ErrorController();
			$control->erro404();
		}
	}
}