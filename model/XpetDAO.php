<?php 

	namespace XPetsIntl;

	class XpetDAO extends Gateway {
		protected $table = "xpet";		

		public function selectAllXpets() {
			$query = 
				"SELECT xpet.name, xpet.id, xpet.description, xpet.classId, class.label as class
				from $this->table
				join class on class.id = xpet.classId";
			
			return $this->c->query($query)->fetchAll();
		}

		public function selectXpetById($id) {
			$query = 
				"SELECT xpet.name, xpet.id, xpet.description, xpet.classId, class.label as class
				from $this->table
				join class on class.id = xpet.classId
				where $this->table.$this->primaryKey = $id";
			
			return $this->c->query($query)->fetch();
		}
	}

?>