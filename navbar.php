<?php

function navbar(){

	$navbar = <<<EOT
    
      <nav class="navbar navbar-inverse"><!--navbar bg-dark navbar-dark-->
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="NavBar.html"><h1>QuickPic</h1></a>
    </div>

     
      <!--<div class="input-group-btn">
      <button class="btn btn-default" type="submit">
       <i class="fas fa-search"></i>
      </button>-->

    <form class="formulaire" action="/action_page.php"><!--navbar-form navbar-left-->
      <div class="form-group">
           <div class="p-2 bd-highlight right">
        <ul>
      <div class="d-flex justify-content-end bd-highlight mb-3 flex">
    <div class="p-2 bd-highlight users"><button type="button" class="btn" onclick="openSideBar()"><i class="far fa-user-circle"></i></button></div>
    <div class="p-2 bd-highlight settings"><li class="btn"><a class="aref" href="#"><i class="fas fa-bars"></i></li></div>
      </ul>
  </div>

    </div>
    </form>
  </div>
</nav>


<!---------------------SIDE BAR-------------------------------------------------------------------------------------------->

<div id="Sidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeSideBar()">&times;</a> <!-- times = 'X'-->
  <a href="Profil.php">Profil</a>
  <a href="#"><!--<i class="far fa-images">&nbsp;-->Gallerie</a>
  <a href="Deconnection.php"><!--<i class="fas fa-door-open">&nbsp;-->Déconnexion</a>
</div>
<script type="text/javascript">
  
  function openSideBar(){

     document.getElementById("Sidebar").style.width = "250px";
  }

  function closeSideBar(){

    document.getElementById("Sidebar").style.width = "0px";
  }

</script>


EOT;

return $navbar;
}

?>