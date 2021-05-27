<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("TeamDAO");
	
	class TeamController {

		public function index() {
			$tm = new TeamDAO();
			$teams = $tm->getAllTeams();

			return TwigController::render(
				"teams-listing",
				[
					"teams" => $teams
				]
			);
		}

		public function formulaire($id = null) {
			if(isset($_SESSION["teamId"])) {
				unset($_SESSION["teamId"]);
			}
			
			if($id != null) {
				$_SESSION["teamId"] = $id;

				$xp = new XPetDAO();
				$xpet = $xp->getXpetById($id);

				return TwigController::render(
					"xpet-formulaire",
					[
						"headerText" => "Formulaire de mise à jour",
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
			
			if(isset($_SESSION["teamId"], $_POST["delete"])) {
				$xp->deleteById($_SESSION["teamId"]);
				unset($_SESSION["teamId"]);
			} else if (isset($_SESSION["teamId"])) {
				$xp->updateId($_SESSION["teamId"], $_POST);
				unset($_SESSION["teamId"]);
			} else {
				$xp->insert($_POST);
			}

			FileController::redirect("xpet");


		}

	}


?>