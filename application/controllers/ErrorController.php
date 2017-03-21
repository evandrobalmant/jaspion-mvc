<?php
class ErrorController extends Controller
{
	public function erro404()
	{
		header("HTTP/1.0 404 Not Found");
		die('Página não encontrada!');
	}
}