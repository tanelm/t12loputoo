<?php
   require("../functions.php");

   $informationError="";
   
   if ( isset($_POST["name"]) &&
		 isset($_POST["city"]) &&
		 isset($_POST["size"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["city"]) &&
		 !empty($_POST["size"])		 ) {
			
		  
		$type = cleanInput($_POST["name"]);
        $name = cleanInput($_POST["city"]);
        $age = cleanInput($_POST["size"]);
		
		$Shop->save($_POST["name"], $_POST["city"], $_POST["size"]);
	}
	
	 if (empty($_POST["name"]) &&
		empty($_POST["city"]) &&
		empty($_POST["size"]))
{
			 $informationError = "Täita tuleb kõik väljad!";
			 
		}

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
<h3>Poe registreerimine</h3>
<form method="POST">
	<label>Poe nimi</label><br>
	<input name="name" type="text" >
	<br><br>
	
	<label>Linn</label><br>
	<input name="city" type="text" >
	<br><br>
	
	<label>Suurus (m2)</label><br>
	<input name="size" type="int" >
	<br><br>
	
	
	<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Salvesta">
	<br><br>
    </form>	
	</div>
</html>	