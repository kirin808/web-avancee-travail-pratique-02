<?php 

	namespace XPetsIntl;

	FileController::model("Gateway");
	FileController::model("XpetDAO");
	FileController::model("ClassGW");

	class XpetController {

		public function form() {
			
		}

		public function index() {
			$classGW = new ClassGW();
			$cl = $classGW->selectAll();

			$xpetGW = new XpetDAO();
			$xp = $xpetGW->selectAllXpets();

			return TwigController::render(
				"xpets-listing",
				[
					"classes" => $cl,
					"xpets" => $xp
				]
			);
		}

		public function formulaire($id = null) {
			$cl = new ClassGW();
			$classes = $cl->selectAll();
			
			if($id != null) {
				$xp = new XPetDAO();
				$xpet = $xp->selectXpetById($id);

				return TwigController::render(
					"formulaire",
					[
						"headerText" => "Formulaire d'enregistrement",
						"classes" => $classes,
						"xpet" => $xpet,
						"update" => true
					]
				);
			} else {
				return TwigController::render(
					"formulaire",
					[
						"headerText" => "Formulaire d'enregistrement",
						"classes" => $classes
					]
				);
			}
		}

		public function updateXpet($id = null) {

		}

	}


?>