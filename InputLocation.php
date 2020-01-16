<?php

require_once("connexion_pdo.php");
$dbh = null;
session_start();
$idUser=$_SESSION['id_user'];

if(isset($_SESSION['pseudo'])&&$_SESSION['pseudo']!=""){
		$dbh = ConnectTODB('localhost','projetweb','user','imtheuser');

		if(isset($_POST['submitLocation'])){
         
         $latitude = $_POST['UserLatitude'];
         $longitude = $_POST['UserLongitude'];
         $sQuery="INSERT INTO post(id_user,latitude,longitude) VALUES (:idUser,:latitude,:longitude)";
         $insert=$dbh->prepare($sQuery);
         $insert->bindParam(':idUser',$idUser,PDO::PARAM_INT);
         $insert->bindParam(':latitude',$latitude,PDO::PARAM_STR,255);
         $insert->bindParam('longitude',$longitude,PDO::PARAM_STR,255);
         header('Home_WebPage.php');

	}
}

?>

<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="bootstrap-css/bootstrap.min.css"><!--classe déjà faite-->
	  <link rel="stylesheet" type="text/css" href="./CSS/InputLocation.css">
	  <script src="https://kit.fontawesome.com/4e1c428a1b.js" crossorigin="anonymous"></script>
	  <title>We need your location</title>
</head>
<body>
     
     <div class="card w-75 mx-auto"> <!--style="width: 18rem;"-->
  <div class="card-header bg-primary text-center text-white">
 <strong>Enregistrement des coordonnées</strong>
</div>
   
  <div class="card-body ">
  	<form method="post" class="form-inline">
		
		<div class="form-group">
			<label for="latitude">Latitude</label>
			<input type="texte" name="UserLatitude" class="form-control mb-2 mr-sm-2" placeholder="Entrer la latitude" id="latitude" autocomplete="off" required>
		</div>

		<div class="form-group">
			<label for="longitude">Longitude</label>
			<input type="texte" name="UserLongitude" class="form-control mb-2 mr-sm-2" placeholder="Enter la longitude" id="longitude" autocomplete="off" required>
		</div>
		<button type="submit" class="btn btn-primary" name="submitLocation">Go!</button>
	</form>
  </div>

</body>
</html>
<style type="text/css">
	
	.card{

		margin-top: 15%;
	}
	body{

		background-color: 

	}
</style>
<script type="text/javascript">
	
	alert("Veuillez indiquez votre position");
</script>