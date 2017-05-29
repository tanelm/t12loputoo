<?php
   require("../functions.php");

   $informationError="";
   
   if ( isset($_POST["type"]) &&
	     isset($_POST["name"]) &&
		 isset($_POST["amount"])&&
		 isset($_POST["shop"]) 	 &&
		 !empty($_POST["type"]) &&
		 !empty($_POST["name"]) &&
		 !empty($_POST["amount"])&&
		 !empty($_POST["shop"])		 ) {
			
		  
		$type = cleanInput($_POST["type"]);
        $name = cleanInput($_POST["name"]);
        $age = cleanInput($_POST["amount"]);
		$shelter = cleanInput($_POST["shop"]);
		
		$Goods->save($_POST["type"], $_POST["name"], $_POST["amount"], $_POST["shop"]);
	}
	
	 if (empty($_POST["type"]) &&
		empty($_POST["name"]) &&
		empty($_POST["amount"])&&
		empty($_POST["shop"]))
{
			 $informationError = "Täita tuleb kõik väljad!";
			 
		}
		
		
		$shop =$Shop->getAll();
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
<h3>Toodete lisamine</h3>
<form method="POST">
	<label>Liik</label><br>
	<select name="type" id="type" name="type">
	<option value="lihatoode">Lihatoode</option>
	<option value="piimatoode">Piimatoode</option>
	<option value="vili">Puu- voi juurvili</option>
	<option value="maiustused">Maiustused</option>
	<option value="alkohol">Alkohol</option>
	</select>
<br><br>
	
	<label>Nimi</label><br>
	<input name="name" type="text" >
<br><br>
	
	<label>Kogus</label><br>
	<input name="amount" type="int" >
<br><br>
				
	<label>Pood</label><br>
	<select name="shop" type="text">
				
<?php
            
$listHtml = "";
        	
foreach($shop as $x){
        		
        		
$listHtml .= "<option value='".$x->name."'>".$x->name."</option>";
        
}
        	
echo $listHtml;
            
?>
</select>
<br>
	
<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Salvesta">
<br><br>
</form>
			
</div>
</body>	
</html>		


