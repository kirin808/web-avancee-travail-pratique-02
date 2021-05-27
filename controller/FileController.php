<?php

	namespace XPetsIntl;

	class FileController {
		static private $rootPath = "/582-31B-MA-Programmation-web-avancees/travail-pratique-02/dev/";

		static function model($page){
			return require_once 'model/'.$page.'.php';
		}
		
		static function redirect($url) {
			header("Location: " . self::$rootPath . $url);
		}
	}
?>