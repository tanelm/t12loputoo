<?php
	require("../functions.php");
	
	
	if(isset($_POST["update"])){
		
		$Goods->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["type"]), $Helper->cleanInput($_POST["name"]), $Helper->cleanInput($_POST["amount"]));
		
		
		header("Location: goodss.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//kustutan
	if(isset($_GET["delete"]) && isset($_GET["id"])){
		
		$Goods->delete($_GET["id"]);
		
		header("Location: goodss.php");
		exit();
	}
	
	
	
	// kui ei ole id'd aadressireal siis suunan
	if(!isset($_GET["id"])){
		header("Location: goodss.php");
		exit();
	}
	
	//saadan kaasa id
	$c = $Goods->getSingle($_GET["id"]);

	if(isset($_GET["success"])){
		echo "Salvestamine onnestus";
	}

	
?>
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
</div>
<div class="mainbar">
<br><br>
<a href="goodss.php"> Tagasi</a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="type" >Liik</label><br>
	<input id="type" name="type" type="text" value="<?php echo $c->type;?>" ><br><br>
  	<label for="name" >Nimi</label><br>
	<input id="name" name="name" type="text" value="<?=$c->name;?>"><br><br>
	<label for="age" >Kogus</label><br>
	<input id="age" name="amount" type="text" value="<?=$c->amount;?>"><br><br>
	
	<input class="btn btn-success btn-sm hidden-xs" type="submit" name="update" value="Uuenda">
  </form>
  
  <br>
 <br>

 <button><a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a></button>
 </div>