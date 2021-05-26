<?php 

	namespace XPetsIntl;

	require_once("Animal.php");

	class Xpet extends Animal {
		protected $superpowers; //  Tableau pour lister les superpouvoirs de l'animal
		protected $id;
		
		function __construct() {
			
		}

		public function getId() {
			return $this->id;
		}

		public function getName() {
			return $this->name;
		}

		public function getClass() {
			return $this->class;
		}

		public function getDescription() {
			return $this->description;
		}
	}
		
?>