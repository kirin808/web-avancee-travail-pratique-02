<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("XpetDAO");
	FileController::model("ClassDAO");

	class XpetController {

		public function form() {
			
		}

		public function index() {
			$classGW = new ClassDAO();
			$cl = $classGW->selectAll();

			$xpetGW = new XpetDAO();
			$xp = $xpetGW->getAllXpets();

			return TwigController::render(
				"xpets-listing",
				[
					"classes" => $cl,
					"xpets" => $xp
				]
			);
		}

		public function formulaire($id = null) {
			$cl = new ClassDAO();
			$classes = $cl->selectAll();
			
			if(isset($_SESSION["xpetId"])) {
				unset($_SESSION["xpetId"]);
			}
			
			if($id != null) {
				$_SESSION["xpetId"] = $id;

				$xp = new XPetDAO();
				$xpet = $xp->getXpetById($id);

				return TwigController::render(
					"xpet-formulaire",
					[
						"headerText" => "Formulaire de mise à jour",
						"classes" => $classes,
						"xpet" => $xpet,
						"update" => true
					]
				);
			} else {
				return TwigController::render(
					"xpet-formulaire",
					[
						"headerText" => "Formulaire d'enregistrement",
						"classes" => $classes
					]
				);
			}
		}

		public function updateXpet() {
			
			$xp = new XpetDAO();
			
			if(isset($_SESSION["xpetId"], $_POST["delete"])) {
				$xp->deleteById($_SESSION["xpetId"]);
				unset($_SESSION["xpetId"]);
			} else if (isset($_SESSION["xpetId"])) {
				$xp->updateId($_SESSION["xpetId"], $_POST);
				unset($_SESSION["xpetId"]);
			} else {
				$xp->insert($_POST);
			}

			FileController::redirect("xpet");


		}

	}


?>