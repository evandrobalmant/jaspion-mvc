<?php
if(function_exists('lcfirst') === false) {
    function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}

class Util
{
	public static function slug( $string ) {
		if (is_string($string)) {
			$string = strtolower(trim(utf8_decode($string)));
	
			$before = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
			$after  = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
			$string = strtr($string, utf8_decode($before), $after);
	
			$replace = array(
					'/[^a-z0-9-]/'	=> '-',
					'/-+/'			=> '-',
					'/\-{2,}/'		=> ''
			);
			$string = preg_replace(array_keys($replace), array_values($replace), $string);
		}
		return $string;
	}
	
	public static function normaliza($string)
	{
		$encoding = 'UTF-8';
	
		$string = mb_convert_case(trim($string), MB_CASE_TITLE, $encoding);
	
		$excecoes = array('de', 'di', 'do', 'da', 'dos', 'das', 'dello', 'della', 'dalla', 'dal', 'del', 'e', 'em', 'na', 'no', 'nas', 'nos', 'van', 'von', 'y', "d'");
	
		$pedacos = explode(" ", $string);
	
		foreach ($pedacos AS $key => $palavra) {
			if(in_array(mb_strtolower($palavra), $excecoes)) {
				$pedacos[$key] = mb_strtolower($palavra);
			}
		}
		$string = implode(" ", $pedacos);
	
		$string = str_replace(
				array("D'a","D'á","D'e","D'é","D'i","D'í","D'o","D'ó","D'u","D'ú","D'","D's","D'j","D'l","D'p","D'g","D'm","D'n"),
				array("d'A","d'Á","d'E","d'É","d'I","d'Í","d'O","d'Ó","d'U","d'Ú","d'","d'S","d'J","d'L","d'P","d'G","d'M","d'N"), $string);
	
		return $string;
	}
}