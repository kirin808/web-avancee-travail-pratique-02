<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("XpetDAO");
	FileController::model("ClassDAO");
	FileController::model("TeamDAO");
	FileController::model("SuperpowerDAO");

	class XpetsController {

		public function index($id = null, $slug = null) {
			$xpetDAO = new XpetDAO();

			if($id != null && $slug != null) {
				if($xp = $xpetDAO->getXpetByIdSlug($id, $slug)) {
					return TwigController::render(
						"xpet-record",
						[
							"xpet" => $xp
						]
					);
				} else {
					FileController::redirect("xpets");
					return;
				}
			}
			

			$xp = $xpetDAO->getAllXpets();

			return TwigController::render(
				"xpets-listing",
				[
					"rootPath" => __DIR__,
					"xpets" => $xp
				]
			);
		}

		public function formulaire($id = null) {
			$clDAO = new ClassDAO();
			$classes = $clDAO->getAllClasses();

			$teamDAO = new TeamDAO();
			$teams = $teamDAO->getAllTeams();

			/* $spowerDAO = new SuperpowerDAO();
			$spowers = $spowerDAO->getAllSuperpowers(); */
			
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
						"teams" => $teams,
						"xpet" => $xpet,
						"update" => true
					]
				);
			} else {
				return TwigController::render(
					"xpet-formulaire",
					[
						"headerText" => "Formulaire d'enregistrement",
						"classes" => $classes,
						"teams" => $teams
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
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);
				
				$xp->updateId($_SESSION["xpetId"], $_POST);
				unset($_SESSION["xpetId"]);
			} else {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);

				$xp->insert($_POST);
			}

			FileController::redirect("xpets");
		}

	}


?>