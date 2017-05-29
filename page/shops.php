<?php
   require("../functions.php");
   
   	if(isset($_GET["s"])){
		
		$s = $_GET["s"];
		
	}else{
		
		$s = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	$shop = $Shop->get($s, $sort, $order);

?>
<html>
<style>
body{
	position:absolute;
	left:15%;
	width:70%;
}
.menubar {
	background-color:#F5F5F5;
	position: absolute;
    border-radius: 25px;
    border: 1px solid #B0E0E6;
}
.mainbar {
	position: absolute;
	left:25%
}
h3 {
    color: blue;
}
menubr {
	line-height: 25px;
 }
</style>
    <head>
<img src="../pics/header.gif" alt="Header">
<br>

<div class="menubar">
	<menubr>
	<ul>
		<li><a href="../index.php">Avaleht</a></li>
		<li><a href="goods.php">Tooted</a></li>
	<ul>
		<li><a href="add_goods.php">Lisa toode</a></li>
		<li><a href="goodss.php">Vaata tooteid</a></li>
	</ul>
	<li><a href="shop.php">Poed</a></li>
		<ul>
		<li><a href="add_shops.php">Lisa poode</a></li>
		<li><a href="shops.php">Vaata poode</a></li>
	</ul>
	</ul>
</div>

<div class="mainbar">

<h3>Kauplused</h3>

<?php 
	
	$html = "<table>";
	
	$html .= "<tr>";
	
		$idOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$idOrder = "DESC";
			$arrow ="&uarr;";
			
		}	
	
		$html .= "<th>
					<a href='?s=".$s."&sort=id&order=".$idOrder."'>
						Id ".$arrow."
					</a>
				 </th>";
				 
		$nameOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$nameOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?s=".$s."&sort=name&order=".$nameOrder."'>
						Nimi ".$arrow."
					</a>
				 </th>";
				 
		$cityOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$cityOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$s."&sort=city&order=".$cityOrder."'>
						Linn ".$arrow."
					</a>
				 </th>";
				 
		$sizeOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$sizeOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?s=".$s."&sort=size&order=".$sizeOrder."'>
						Pindala(m2) ".$arrow."
					</a>
				 </th>";
				 

		foreach($shop as $s){
			$html .= "<tr>";
				$html .= "<td>".$s->id."</td>";
				$html .= "<td>".$s->name."</td>";
				$html .= "<td>".$s->city."</td>";
				$html .= "<td>".$s->size."</td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;

?>