<?php require("../header.php"); 

	require("../functions.php");
   
   //kas on sisseloginud, kui ei ole siis
   //suunata login lehele
   if (!isset ($_SESSION["userId"])) {
	   
	   //header("Location: login.php");
	   
	}
   
   //kas ?loguout on aadressireal
   if (isset($_GET["logout"])) {
	   
	   session_destroy();
	   
	   header("Location: login.php");
	   exit();
	   
   }  
   $informationError="";
?>	
<div class="container">
	<body style='background-color:Silver'>
	<head>
	<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
</head>
<table style="width:100%">
  <tr>
  <th>
	    <h1>Tööline</h1>
		<label>Henri V.</label>
	    <br>
		<label>Telefon 12345678</label>
	    <br>
		<label>E-post henriv@koduloomadelaenutus.ee</label>
		<br>
	</th>
	</tr>
			
	<tr>
	<th>
	<h1>Tööline</h1>
		<label>Tanel M.</label>
	    <br>
		<label>Telefon 1122334455</label>
	    <br>
	    <label>E-post tanelm@koduloomadelaenutus.ee</label>
	    <br>
	</tr>
	</th>
		
	<tr>
	<th>
	<h1>Tööline</h1>
		<label>Cleven L.</label>
	    <br>
		<label>Telefon 98765432</label>
	    <br>
	    <label>E-post clevenl@koduloomadelaenutus.ee</label>
		<br>	
	</tr>
	</th>
	
</div>
</table>
<?php require("../footer.php"); ?>