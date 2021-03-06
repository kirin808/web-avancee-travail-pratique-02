<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("TeamDAO");
	FileController::model("XpetDAO");
	
	class TeamsController {
		private $controllerSlug = "teams";

		public function index($id = null, $slug = null) {
			$teamDAO = new TeamDAO();
						
			if($id != null && $slug != null) {
				$xpetDAO = new XpetDAO();
				$team = $teamDAO->getTeamById($id);

				if($xp = $xpetDAO->getXpetsByCategoryIdSlug("team", $id, $slug)) {
					return TwigController::render(
						"category-record",
						[
							"entry" => $team,
							"xpets" => $xp,
							"controllerSlug" => $this->controllerSlug,

							// Textes personnalisés
							"entryLabelTextPlur" => "équipes",
							"entryLabelTextSing" => "équipe",
							"animalsTitleText" => "Membres de l'équipe"
						]
					);
				} else {
					FileController::redirect($this->controllerSlug);
					return;
				}
			}
						
			$teams = $teamDAO->getAllTeams();

			return TwigController::render(
				"categories-listing",
				[
					"controllerSlug" => $this->controllerSlug,
					"entries" => $teams,

					// Textes personnalisés
					"entryLabelTextPlur" => "équipes",
					"entryLabelTextSing" => "équipe"
				]
			);
		}

		public function formulaire($id = null) {
			if(isset($_SESSION["teamId"])) {
				unset($_SESSION["teamId"]);
			}
			
			if($id != null) {
				$_SESSION["teamId"] = $id;

				$teamDAO = new TeamDAO();
				$t = $teamDAO->getTeamById($id);

				return TwigController::render(
					"category-formulaire",
					[
						"controllerSlug" => $this->controllerSlug,
						"entry" => $t,
						"update" => true,
						"action" => "updateTeam",

						// Textes personnalisés
						"headerText" => "Formulaire de mise à jour"
					]
				);
			} else {
				return TwigController::render(
					"category-formulaire",
					[
						"controllerSlug" => $this->controllerSlug,

						// Textes personnalisés
						"headerText" => "Formulaire d'enregistrement"
					]
				);
			}
		}

		public function updateTeam() {
			
			$teamDAO = new TeamDAO();
			
			if(isset($_SESSION["teamId"], $_POST["delete"])) {
				$teamDAO->deleteById($_SESSION["teamId"]);
				unset($_SESSION["teamId"]);
			} else if (isset($_SESSION["teamId"])) {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);

				$teamDAO->updateId($_SESSION["teamId"], $_POST);
				unset($_SESSION["teamId"]);
			} else {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);
				
				$teamDAO->insert($_POST);
			}

			FileController::redirect($this->controllerSlug);
		}

	}


?>