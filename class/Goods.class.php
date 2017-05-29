<?php 
class Goods {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}

	/*TEISED FUNKTSIOONID */
	function delete($id){

		$stmt = $this->connection->prepare("UPDATE goods SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Kustutamine õnnestus!";
		}
		
		$stmt->close();
		
		
	}
		
	function get($q, $sort, $order) {
		
		$allowedSort = ["id", "type", "name", "amount", "shop"];
		
		if(!in_array($sort, $allowedSort)){
			// ei ole lubatud tulp
			$sort = "id";
		}

		
		$orderBy = "ASC";
		
		if ($order == "DESC") {
			$orderBy = "DESC";
		}
		//echo "Sorteerin: ".$sort." ".$orderBy." ";
		
		
		//kas otsib
		if ($q != "") {
			
			echo "Otsib: ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, type, name, amount, shop
				FROM goods
				WHERE deleted IS NULL
				
			
				AND (type LIKE ? OR name LIKE ? OR amount LIKE ? OR shop LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("ssis", $searchWord, $searchWord, $searchWord, $searchWord);
			
			
		} else {
			
			$stmt = $this->connection->prepare("
				SELECT id, type, name, amount, shop
				FROM goods
				WHERE deleted IS NULL
				
				ORDER BY $sort $orderBy
			");
			
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result($id, $type, $name, $amount, $shop);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$Goods = new StdClass();
			
			$Goods->id = $id;
			$Goods->type = $type;
			$Goods->name = $name;
			$Goods->amount = $amount;
			$Goods->shop = $shop;
			

			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $Goods);
		}
		
		$stmt->close();
		
		
		return $result;
	}
	

	
	function getSingle($edit_id){

		$stmt = $this->connection->prepare("SELECT id, type, name, amount, shop FROM `goods` WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($id, $type, $name, $amount, $shop);
		$stmt->execute();
		
		//tekitan objekti
		$Goods = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$Goods->id = $id;
			$Goods->type = $type;
			$Goods->name = $name;
			$Goods->amount = $amount;
			$Goods->shop = $shop;
			
			
		}else{
			header("Location: goods.php");
			exit();
		}
		
		$stmt->close();
		
		
		return $Goods;
		
	}

	function save ($type, $name, $amount, $shop) {
		
		$stmt = $this->connection->prepare("INSERT INTO goods (type, name, amount, shop) VALUES (?, ?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("ssis", $type, $name, $amount, $shop);
		
		if($stmt->execute()) {
			echo "Salvestamine onnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
	function update($id, $type, $name, $amount){
    	
		$stmt = $this->connection->prepare("UPDATE goods SET type=?, name=?, amount=? WHERE id=?");
		$stmt->bind_param("ssii",$type, $name, $amount, $id);
		
		
		// kas õnnestus salvestada
		if($stmt->execute()) {
			echo "Salvestamine onnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}
	
}
?>