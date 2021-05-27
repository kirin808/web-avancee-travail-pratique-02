<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("XpetDAO");
	FileController::model("ClassDAO");

	class XpetController {

		public function index($id = null, $name = null) {
			$xpetDAO = new XpetDAO();

			if(
				$id != null &&
				$name != null &&
				$xp = $xpetDAO->getXpetByIdSlug($id, $name)
			) {
				return TwigController::render(
					"xpet-record",
					[
						"xpet" => $xp
					]
				);
			}
			

			$xp = $xpetDAO->getAllXpets();

			return TwigController::render(
				"xpets-listing",
				[
					"xpets" => $xp
				]
			);
		}

		public function formulaire($id = null) {
			$clDAO = new ClassDAO();
			$classes = $clDAO->selectAll();
			
			if(isset($_SESSION["xpetId"])) {
				unset($_SESSION["xpetId"]);
			}
			
			if($id != null) {
				$_SESSION["xpetId"] = $id;

				$xpDAO = new XPetDAO();
				$xpet = $xpDAO->getXpetById($id);

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