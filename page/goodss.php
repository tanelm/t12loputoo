<?php
   require("../functions.php");
   
   	if(isset($_GET["q"])){
		
		$q = $_GET["q"];
		
	}else{
		
		$q = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	if(isset($_GET["b"])){
		
		$b = $_GET["b"];
		
	}else{
		
		$b = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	 	if(isset($_GET["b"])){
		
		$q = $_GET["b"];
		
	}else{
		
		$b = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	//otsisõna fn sisse
	$goods = $Goods->get($q, $sort, $order);

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
<h3>Kaubad</h3>

<form>

	<input type="search" name="q" value="<?=$q;?>">
	<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Otsi">
	
</form>
<?php 
	
	$html = "<table>";
	
	$html .= "<tr>";
	
		
		$typeOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$typeOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=type&order=".$typeOrder."'>
						Liik ".$arrow."
					</a>
				 </th>";
				 
		$nameOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$nameOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=name&order=".$nameOrder."'>
						Nimi ".$arrow."
					</a>
				 </th>";
				 
		$amountOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$amountOrder = "DESC";
			$arrow ="&uarr;";
		}
		
		$html .= "<th>
					<a href='?q=".$q."&sort=amount&order=".$amountOrder."'>
						Kogus ".$arrow."
					</a>
				 </th>";
		
		$shopOrder = "ASC";
		$arrow ="&darr;";
		if (isset($_GET["order"]) && $_GET["order"] == "ASC"){
			$shopOrder = "DESC";
			$arrow ="&uarr;";
			
		}	
	
		$html .= "<th>
					<a href='?q=".$q."&sort=shop&order=".$shopOrder."'>
						Kauplus ".$arrow."
					</a>
				 </th>";
				 
		foreach($goods as $c){
			$html .= "<tr>";
				$html .= "<td>".$c->type."</td>";
				$html .= "<td>".$c->name."</td>";
				$html .= "<td>".$c->amount."</td>";
				$html .= "<td>".$c->shop."</td>";
				$html .= "<td><a class='btn btn-default btn-sm' href='edit.php?id=".$c->id."'><span class='glyphicon glyphicon-pencil'></span>Muuda</a></td>";
			$html .= "</tr>";	
		}
		
	$html .= "</table>";
	echo $html;
?>
</div>