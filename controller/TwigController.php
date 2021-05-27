<?php 

	namespace XPetsIntl;
	
	class TwigController {
		private static $ext = ".twig";

		static public function render($template, $data) {
			
			$loader = new \Twig\Loader\FilesystemLoader("view");
		
			$twig = new \Twig\Environment(
				$loader,
				array(
					"auto_reload" => true,
					"cache" => false
				)
			);
				
			return $twig->render($template . self::$ext, $data);
		}
	}


?>