<?php 
class Shop {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
function save ($name, $city, $size) {
	
		$stmt = $this->connection->prepare("INSERT INTO shops (name, city, size) VALUES (?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("sss", $name, $city, $size);
		
		if($stmt->execute()) {
			echo "Salvestamine onnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}

function get($s, $sort, $order) {
		
		$allowedSort = ["id", "name", "city", "size"];
		
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
		if ($s != "") {
			
			echo "Otsib: ".$s;
			
			$stmt = $this->connection->prepare("
				SELECT name, city, size
				FROM shops
				AND (name LIKE ? OR city LIKE ? OR size LIKE ?)
				
			");
			$searchWord = "%".$s."%";
			$stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);
			
			
		} else {
			
			$stmt = $this->connection->prepare("
				SELECT id, name, city, size
				FROM shops
				ORDER BY $sort $orderBy
			");
			
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result($id, $name, $city, $size);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$shop = new StdClass();
			
			$shop->id = $id;
			$shop->name = $name;
			$shop->city = $city;
			$shop->size = $size;
			

			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $shop);
		}
		
		$stmt->close();
		
		
		return $result;
	}

function getSingle($edit_id) {

		$stmt = $this->connection->prepare("SELECT name, city, size FROM `shops` WHERE id=?");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($name, $city, $size);
		$stmt->execute();
		
		//tekitan objekti
		$Shop = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$Shop->name = $name;
			$Shop->city = $city;
			$Shop->size = $size;
			
			
		}else{
			header("Location: goods.php");
			exit();
		}
		
		$stmt->close();
		
	}
function getAll() {
		
		$database = "if16_tanelmaas_java";
		$this-> connection= new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $this-> connection->prepare("
			SELECT id, name
			FROM shops
		");
		echo $this-> connection->error;
		
		$stmt->bind_result($id, $name);
		$stmt->execute();
		
		
		$result = array();
		
		while ($stmt->fetch()) {
			
			$i = new StdClass();
			
			$i->id = $id;
			$i->name = $name;
		
			array_push($result, $i);
		}
		
		$stmt->close();
		
		return $result;
	}
}
?>