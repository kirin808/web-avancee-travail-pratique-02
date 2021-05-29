<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("SuperpowerDAO");
	FileController::model("XpetDAO");
	
	class SuperpowersController {
		private $controllerSlug = "superpowers";

		public function index($id = null, $slug = null) {
			$spowerDAO = new SuperpowerDAO();
						
			if($id != null && $slug != null) {
				$xpetDAO = new XpetDAO();
				$sp = $spowerDAO->getSuperpowerById($id);

				if($xp = $xpetDAO->getXpetsByCategoryIdSlug("superpower", $id, $slug)) {
					return TwigController::render(
						"category-record",
						[
							"entry" => $sp,
							"xpets" => $xp,
							"controllerSlug" => $this->controllerSlug,

							// Textes personnalisés
							"entryLabelTextPlur" => "superpouvoirs",
							"entryLabelTextSing" => "superpouvoir",
							"animalsTitleText" => "Liste des superpouvoirs"
						]
					);
				} else {
					FileController::redirect($this->controllerSlug);
					return;
				}
			}
						
			$spowers = $spowerDAO->getAllSuperpowers();

			return TwigController::render(
				"categories-listing",
				[
					"controllerSlug" => $this->controllerSlug,
					"entries" => $spowers,

					// Textes personnalisés
					"entryLabelTextPlur" => "superpouvoirs",
					"entryLabelTextSing" => "superpouvoir"
				]
			);
		}

		public function formulaire($id = null) {
			if(isset($_SESSION["superpowerId"])) {
				unset($_SESSION["superpowerId"]);
			}
			
			if($id != null) {
				$_SESSION["superpowerId"] = $id;

				$spowerDAO = new SuperpowerDAO();
				$sp = $spowerDAO->getSuperpowerById($id);

				return TwigController::render(
					"category-formulaire",
					[
						"controllerSlug" => $this->controllerSlug,
						"entry" => $sp,
						"update" => true,
						"action" => "updateSuperpower",

						// Textes personnalisés
						"headerText" => "Formulaire de mise à jour"
					]
				);
			} else {
				return TwigController::render(
					"category-formulaire",
					[
						"controllerSlug" => $this->controllerSlug,
						"action" => "updateSuperpower",

						// Textes personnalisés
						"headerText" => "Formulaire d'enregistrement"
					]
				);
			}
		}

		public function updateSuperpower() {
			
			$teamDAO = new SuperpowerDAO();
			
			if(isset($_SESSION["superpowerId"], $_POST["delete"])) {
				$teamDAO->deleteById($_SESSION["superpowerId"]);
				unset($_SESSION["superpowerId"]);
			} else if (isset($_SESSION["superpowerId"])) {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);

				$teamDAO->updateId($_SESSION["superpowerId"], $_POST);
				unset($_SESSION["superpowerId"]);
			} else {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);
				
				$teamDAO->insert($_POST);
			}

			FileController::redirect($this->controllerSlug);
		}

	}


?>