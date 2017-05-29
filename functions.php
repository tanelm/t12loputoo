<?php

    require("/home/tanelmaas/config.php");
	// functions.php
	//var_dump($GLOBALS);
		/* ÜHENDUS */
	$database = "if16_tanelmaas_java";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	require("../class/Goods.class.php");
	$Goods = new Goods($mysqli);
	
	require("../class/Shop.class.php");
	$Shop= new Shop($mysqli);
	
	require("../class/Helper.class.php");
	$Helper= new Helper($mysqli);
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
	

	function cleanInput($input) {
		
		//input = "romiL@tlu.ee   "
		
		$input = trim($input);
		
		//input = "romiL@tlu.ee"
			
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
		
	}


