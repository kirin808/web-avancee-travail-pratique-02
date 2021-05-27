<?php 

	namespace XPetsIntl;

	class XpetDAO extends Gateway {
		protected $table = "xpet";		

		public function getAllXpets() {
			$query = 
				"SELECT xpet.name, xpet.id, xpet.description, xpet.classId, class.label as class
				from $this->table
				join class on class.id = xpet.classId";
			
			return $this->c->query($query)->fetchAll();
		}

		public function getXpetById($id) {
			$stmt = $this->prepareStmt( 
				"SELECT xpet.name, xpet.id, xpet.description, xpet.classId, class.label as class
				from $this->table
				join class on class.id = xpet.classId
				where $this->table.$this->primaryKey = :id"
			);
			
			if($stmt->execute([":id" => $id]))
				return $stmt->fetch();
			else {
				return false;
			};
		}
	}

?>