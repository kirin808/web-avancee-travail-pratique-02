<?php 
	namespace XPetsIntl;

	abstract class DbConnect {

		protected $hostname;
		protected $database;
		protected $username;
		protected $password;

		public function __construct($h, $d, $u, $p) {
			$this->hostname = $h;
			$this->database = $d;
			$this->username = $u;
			$this->password = $p;
			
			try {
				$this->c = new \PDO("mysql:host=$h;dbname=$d", $u, $p);
				$this->c->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			} catch (\PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			// $this->c = new \PDO("mysql:host=$h;dbname=$d", $u, $p);
		}

	}

?>