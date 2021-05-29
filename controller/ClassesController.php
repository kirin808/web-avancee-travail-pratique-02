<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("ClassDAO");
	FileController::model("XpetDAO");
	
	class ClassesController {
		private $controllerSlug = "classes";

		public function index($id = null, $slug = null) {
			$classDAO = new classDAO();
						
			if($id != null && $slug != null) {
				$xpetDAO = new XpetDAO();
				$class = $classDAO->getClassById($id);

				if($xp = $xpetDAO->getXpetsByCategoryIdSlug("class", $id, $slug)) {
					return TwigController::render(
						"category-record",
						[
							"entry" => $class,
							"xpets" => $xp,
							"controllerSlug" => $this->controllerSlug,

							// Textes personnalisés
							"entryLabelTextPlur" => "classes",
							"entryLabelTextSing" => "classe",
							"animalsTitleText" => "Animaux de cette classe"
						]
					);
				} else {
					FileController::redirect($this->controllerSlug);
					return;
				}
			}
						
			$classes = $classDAO->getAllClasses();

			return TwigController::render(
				"categories-listing",
				[
					"controllerSlug" => $this->controllerSlug,
					"entries" => $classes,

					// Textes personnalisés
					"entryLabelTextPlur" => "classes",
					"entryLabelTextSing" => "classe"
				]
			);
		}

		public function formulaire($id = null) {
			if(isset($_SESSION["classId"])) {
				unset($_SESSION["classId"]);
			}
			
			if($id != null) {
				$_SESSION["classId"] = $id;

				$classDAO = new classDAO();
				$t = $classDAO->getClassById($id);

				return TwigController::render(
					"category-formulaire",
					[
						"controllerSlug" => $this->controllerSlug,
						"entry" => $t,
						"update" => true,
						"action" => "updateClass",

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

		public function updateClass() {
			
			$classDAO = new classDAO();
			
			if(isset($_SESSION["classId"], $_POST["delete"])) {
				$classDAO->deleteById($_SESSION["classId"]);
				unset($_SESSION["classId"]);
			} else if (isset($_SESSION["classId"])) {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);
				
				$classDAO->updateId($_SESSION["classId"], $_POST);
				unset($_SESSION["classId"]);
			} else {
				$sluger = new \Cocur\Slugify\Slugify();
				
				$_POST["slug"] = $sluger->slugify($_POST["name"]);

				$classDAO->insert($_POST);
			}

			FileController::redirect($this->controllerSlug);
		}

	}


?>