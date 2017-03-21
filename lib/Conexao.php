<?php
class Conexao extends PDO
{
	public function __construct()
	{
		if (isset($this->db)) {
			$db = 'db:' . $this->db;
		} else {
			$db = 'db';
		}
		
		//Carrega os parâmetros para conexão, que estão no arquivo application.ini
		$adapter	= @Application::$config[$db]['adapter'];
		$host		= @Application::$config[$db]['host'];
		$username	= @Application::$config[$db]['username'];
		$password	= @Application::$config[$db]['password'];
		$dbname		= @Application::$config[$db]['dbname'];
		$charset	= @Application::$config[$db]['charset'];
		
		try {
			/*
			 * Abre uma conexão com banco de dados
			 * Executa o construtor da classe "pai", que é a classe PDO
			 */
			switch (Application::$config[$db]['adapter'])
			{
				case 'sqlite':
					$dbsrc = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $dbname;
					parent::__construct("{$adapter}:{$dbsrc}", "", "", array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
					
					break;
				case 'mysql':
					parent::__construct("{$adapter}:host={$host};dbname={$dbname}", $username, $password, array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
					parent::exec("SET NAMES '{$charset}';");
					
					break;
				default:
					parent::__construct("{$adapter}:host={$host};dbname={$dbname}", $username, $password, array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					));
			}
			
		} catch (Exception $e) {
			echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
		}
	}
}