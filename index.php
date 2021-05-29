<?php
	namespace XPetsIntl;

	session_start();

	define(__NAMESPACE__ . "\NS", __NAMESPACE__ . "\\");
	define(__NAMESPACE__ . "\ROOTPATH", "/582-31B-MA-Programmation-web-avancees/travail-pratique-02/dev/");

	require_once __DIR__ . '/controller/FileController.php';
	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/controller/TwigController.php';

	
	//recuperer le chemin (URL) et mettre dans un tableau
	$url = isset($_SERVER['PATH_INFO']) ? explode ('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/' ;

	if($url == "/"){
		FileController::redirect("xpets");
	} else{
		$requestUrl = $url[0];
		
		//recuperer le controleur
		$controllerPath = __DIR__ . "/controller/" . ucfirst($requestUrl) . "Controller.php";
		
		if(file_exists($controllerPath)) {
			
			require_once $controllerPath;
		
			$controllerName = NS . ucfirst($requestUrl).'Controller';
			$controller = new $controllerName;

			if(isset($url[1])) {
				$id = null;

				if(is_numeric($url[1]) && isset($url[2])) {
					echo $controller->index($url[1], $url[2]);
				} else {
					$method = $url[1];

					if(isset($url[2]) && is_numeric($url[2])) {
						$id = $url[2];
					}
					
					if(method_exists($controller, $method)) {
						echo $controller->$method($id);		
					} else {
						FileController::redirect("xpets");	
					}
				}				

				/* if(isset($url[2]) && is_numeric($url[2])) {
					$id = $url[2];
				}

				if(method_exists($controller, $method)) {
					echo $controller->$method($id);			
				} else {
					FileController::redirect("xpet");		
				} */
			} else {
				echo $controller->index();
			}			
		} else {
			FileController::redirect("xpet");
		}

	}

?>