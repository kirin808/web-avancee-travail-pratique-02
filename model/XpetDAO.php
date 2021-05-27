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
				"SELECT xpet.name, xpet.id, xpet.description, xpet.slug, xpet.classId, class.label as class
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

		public function getXpetByIdSlug($id, $slug) {
			$stmt = $this->prepareStmt( 
				"SELECT xpet.name, xpet.id, xpet.description, xpet.classId, class.label as class
				from xpet
				join class on class.id = xpet.classId
				where xpet.$this->primaryKey = :id
					and xpet.slug = :slug"
			);
			
			if($stmt->execute(
					[
						":id" => $id,
						":slug" => $slug
					]
				)
			)
				return $stmt->fetch();
			else {
				return false;
			};
		}
	}

?>