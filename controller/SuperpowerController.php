<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("SuperpowerDAO");
	
	class SuperpowerController {

		public function index() {
			$sp = new SuperpowerDAO();
			$spowers = $sp->getAllSuperpowers();

			return TwigController::render(
				"superpowers-listing",
				[
					"superpowers" => $spowers
				]
			);
		}

		public function formulaire($id = null) {
				
			if(isset($_SESSION["spowerId"])) {
				unset($_SESSION["spowerId"]);
			}
			
			if($id != null) {
				$_SESSION["spowerId"] = $id;

				$sp = new SuperpowerDAO();
				$spower = $sp->getSuperpowerById($id);

				return TwigController::render(
					"superpower-formulaire",
					[
						"headerText" => "Mettre à jour un superpouvoir",
						"superpower" => $spower,
						"update" => true
					]
				);
			} else {
				return TwigController::render(
					"superpower-formulaire",
					[
						"headerText" => "Ajouter un superpouvoir"					
					]
				);
			}
		}

		public function updateSuperpower() {
			
			$xp = new SuperpowerDAO();
			
			if(isset($_SESSION["spowerId"], $_POST["delete"])) {
				$xp->deleteById($_SESSION["spowerId"]);
				unset($_SESSION["spowerId"]);
			} else if (isset($_SESSION["spowerId"])) {
				$xp->updateId($_SESSION["spowerId"], $_POST);
				unset($_SESSION["spowerId"]);
			} else {
				$xp->insert($_POST);
			}

			FileController::redirect("superpower");
		}

	}


?>