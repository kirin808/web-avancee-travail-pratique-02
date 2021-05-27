<?php 

	namespace XPetsIntl;

	require_once("DbConnect.php");

	abstract class Gateway extends DbConnect {
		protected $table;
		protected $primaryKey = "id";

		/**
		 * 
		 * @param $d Tableau associatif contenant les noms de colonnes et leurs valeurs associées
		 * @param $values Si l'on doit créer une chaine pour le "côté" valeur du binding
		 * 
		 */
		function getFieldsToString($d, $values = false) {
			if(!$values) {
				return implode(", ", array_keys($d));
			}

			return ':' . implode(", :", array_keys($d));
			
		}

		function getUpdateString($d) {
			$str = "";

			foreach($d as $key=>$v){
				$str .="$key=:$key,";
			}

			return rtrim($str, ",");
		}

		function getWhereCondition($c) {
			$str = "WHERE ";

			foreach($c as $field => $value) {
				$str .= "$field = $value AND ";
			}

			return rtrim($str, " AND ");
		}

		function prepareStmt($s) {
			return $this->c->prepare($s);
		}

		function insert($data) {
			$stmt = $this->prepareStmt(
				"INSERT INTO $this->table ({$this->getFieldsToString($data)})
				 VALUES ({$this->getFieldsToString($data, true)})"
			);
			
			foreach ($data as $key => $value) {
				$stmt->bindValue(":$key", $value);
			}

			if(!$stmt->execute()){
				echo "Erreur d'insertion";
				return implode(" :: ", $stmt->errorInfo());
			}else{
				return true;
			}
		}

		function update($data, $conditions) {

			$stmt = $this->prepareStmt(
				"UPDATE $this->table
				 SET {$this->getUpdateString($data)}
				 {$this->getWhereCondition($conditions)}"
			);
			
			foreach ($data as $key => $value) {
				$stmt->bindValue(":$key", $value);
			}

			if(!$stmt->execute()){
				echo "Erreur de mise à jour";
				return implode(" :: ", $stmt->errorInfo());
			}else{
				return true;
			}
		}

		function selectAll($conditions = NULL, $orderBy = null, $order = "ASC") {
			$sql =
				"SELECT *
				 FROM $this->table";

			if(isset($conditions)) $sql .= " {$this->getWhereCondition($conditions)}";
			if(isset($orderBy)) $sql .= " ORDER BY $orderBy $order";

			return $this->c->query($sql)->fetchAll();
		}

		function selectById($id, $field = "id") {
			$sql = "SELECT * FROM $this->table WHERE $field = $id";
			return $this->c->query($sql)->fetch();
		}

		function deleteById($id, $field = "id") {
			$sql = "DELETE from $this->table where $field = $id";
			return $this->c->query($sql)->rowCount() > 0;
		}
	}


?>