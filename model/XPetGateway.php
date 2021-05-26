<?php 

	namespace XPetsIntl;

	class XPetGateway extends Gateway {
		protected $table = "xpet";

		function __construct($h, $d, $u, $p) {
			parent::__construct($h, $d, $u, $p);
			
		}
	}

?>