
<?php
   
   require_once('connexion_pdo.php');
   require_once('navbar.php');
   session_start();
  // echo $_SESSION['id_user'];
  // require_once('Cookie_Organisation_Script.js');

   $dbh = ConnectTODB('localhost','projetweb','user','imtheuser');
   $sError="";
   $idUser = $_SESSION['id_user'];

  // retrieve value for input 'Actuel'--------------------------------
  $sQuery = "SELECT*FROM user WHERE id_user=:idUser";
  $resultat = $dbh->prepare($sQuery);
  $resultat->bindParam(':idUser',$idUser,PDO::PARAM_INT);
  
  if(!$resultat->execute()){

    echo "erreur";
  }else{

   $row = $resultat->fetch(PDO::FETCH_ASSOC);
   $pseudo = $row['pseudo'];
   $mail = $row['email'];
   /*echo $pseudo;
   echo $mail;*/

  }

  function UpdateSettingsUser($dbh,$column,$valueUpdate,$idUser){
      
      $sQuery ="UPDATE user SET $column = :newvalue WHERE id_user =:idUser";
      
      //echo $sQuery;

      $resultat = $dbh->prepare($sQuery);
      $resultat->bindParam(':newvalue',$valueUpdate,PDO::PARAM_STR,255);
      $resultat->bindParam(':idUser',$idUser,PDO::PARAM_INT);

      if(!$resultat->execute()){

        echo 'Erreur connexion DB';
      }else{

        echo "Done!";
      }
   }



   if(isset($_POST['saveNewPseudo'])){
        
        if(!empty($_POST['newPseudo'])){
          $Pseudo = $_POST['newPseudo'];
          $column="pseudo";
          //echo 'j\' ai pris'.$pseudo;
          UpdateSettingsUser($dbh,$column,$Pseudo,$idUser);

        }else{

          echo "Veuillez remplir le champs 'Nouveau' ";
        }
   }

   if(isset($_POST['saveNewMail'])){
        
        if(!empty($_POST['newMail'])){
          $Mail = $_POST['newMail'];
          $column="email";
          UpdateSettingsUser($dbh,$column,$Mail,$idUser);
          
        }else{

          echo "Veuillez remplir le champs 'Nouveau' ";
        }
   }

   if(isset($_POST['deleteAccount'])){
     
     $sQuerydelete = "DELETE FROM user WHERE id_user=:idUser";
     $resultat=$dbh->prepare($sQuerydelete);
     $resultat->bindParam(':idUser',$idUser,PDO::PARAM_INT);

     if(!$resultat->execute()){

        echo "Erreur connxion DB";
     }else{

         header('Location: SignIn.php');
     }

   }

   if(isset($_POST['saveNewPW'])){
                      
                      //dbPassword = pw in input "Actuel"
      if(!empty($_POST['dbPassword']) AND !empty($_POST['newPassword'])){

        
        $dbPassword = $_POST['dbPassword'];
        $sQueryPW = "SELECT* FROM user WHERE id_user=:idUser";
        $resultat = $dbh->prepare($sQueryPW);
        $resultat->bindParam(':idUser',$idUser,PDO::PARAM_INT);

        if(!$resultat->execute()){

          echo "Probleme execution";
        }else{
           
        $row = $resultat->fetch(PDO::FETCH_ASSOC);
        $hshPass=$row['password'];
        if(password_verify($dbPassword, $hshPass)){
          
          $PW = $_POST['newPassword'];
          $hshmdp= password_hash($PW, PASSWORD_DEFAULT);
          $column ="password";
          UpdateSettingsUser($dbh,$column,$hshmdp,$idUser);


        }else{

          $sError="Mot de passe actuel incorrect";
        }

        }
      }else{

        echo "Vous n'avez pas rempli les champs";
      }
      

   }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="bootstrap-css/bootstrap.min.css"> <!--classe déjà faite-->
 <link rel="stylesheet" type="text/css" href="bootstrap-css/navbar.css">
 <link rel="stylesheet" href="fontawesome-free-web/css/font-awesome.min.css"><!--TESTER en local-->
 <script src="https://kit.fontawesome.com/4e1c428a1b.js" crossorigin="anonymous"></script>
   
  <!--for collapse------------------------------->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<title>Profil</title>
</head>
<body>

<?php $navbar = navbar();
      echo $navbar;
?>
<div id="accordion">
	<!---Settings for Profil------------------->
  <div class="card cardSettingsProfil">
   

    <!--Header of Card Profil-->
    <h5 class="card-header bg-primary text-center text-white">
    <strong>Paramètres généraux du compte</strong>
    </h5>
    <!------------------------------->
  <form method="post">
   <!--Settings Pseudo---------------->
  <div class="card cardPseudo">
    <div class="card-header settingsPseudo">
      <span>Pseudo</span>
      <a class="clickPseudo" data-toggle="collapse" href="#collapseSettingsPseudo">
        Modifier
      </a>
    </div>
    
    <!-----Hidden part of settings Pseudo---->
    <div id="collapseSettingsPseudo" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Actuel <input type="text" name="dbPseudo" value="<?php echo $pseudo ?>">
        Nouveau <input type="text" name="newPseudo" autocomplete="off">
        <button class="btn" type="submit" name="saveNewPseudo">Sauvegarder</button>
      </div>
    </div>
  </div>

  <div class="card cardContact">
    <div class="card-header settingsContact">
        <span>Contact</span>
      <a class="clickContact" data-toggle="collapse" href="#collapseSettingsContact">
        Modifier
      </a>
    </div>

    <div id="collapseSettingsContact" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Actuel <input type="text" name="dbMail" value="<?php echo $mail ?>">
        Nouveau <input type="text" name="newMail" autocomplete="off">
        <button class="btn" type="submit" name="saveNewMail">Sauvegarder</button>
      </div>
    </div>
  </div>

</div>

<div class="card cardAccount">
    <div class="card-header settingsAccount">
        <span>Gestion du compte</span>
     <form method="post"><button class="btn" type="submit" name="deleteAccount">Delete Account</button></form>
    </div>

</div>
</form>
</div><!------------END Card Profil------------------------>

<div class="card cardSettingsPW">
	<h5 class="card-header bg-primary text-center text-white">
   <strong>Connexion</strong>
  </h5>
  <form method="post">
  <div class="card cardPW">
    <div class="card-header settingsPW">
      <i class="fas fa-key"></i>&nbsp;Changer le mot de passe
      <a class="clickPW" data-toggle="collapse" href="#collapseSettingsPW">
       Modifier
      </a>
    </div>
    <!-----Hidden part of settings Password---->
    <div id="collapseSettingsPW" class="collapse" data-parent="#accordion"><!-- parent accordion close other open card-->
      <div class="card-body">
       	 Actuel <input type="password" name="dbPassword">
         Nouveau <input type="password" name="newPassword" autocomplete="off">
         <button class="btn" type="submit" name="saveNewPW">Sauvegarder</button>
         <?php echo $sError?>
      </div>
    </div>
    <!------------------------------------->
</form>
  </div>
  <!------------------------------------------------>
</div>
</body>
<script>
$(document).ready(function(){

    $("#collapseSettingsPseudo").on("hide.bs.collapse", function(){
    $(".clickPseudo").html('Modifier');
  });
  $("#collapseSettingsPseudo").on("show.bs.collapse", function(){
    $(".clickPseudo").html('Annuler');
  });

    $("#collapseSettingsContact").on("hide.bs.collapse", function(){
    $(".clickContact").html('Modifier');
  });
  $("#collapseSettingsContact").on("show.bs.collapse", function(){
    $(".clickContact").html('Annuler');
  });

  $("#collapseSettingsPW").on("hide.bs.collapse", function(){
    $(".clickPW").html('Modifier');
  });
  $("#collapseSettingsPW").on("show.bs.collapse", function(){
    $(".clickPW").html('Annuler');
  });
});
/*$(".btn").click(function(){
    $(".collapse").collapse('toggle');
  });*/
</script>
</html>