<?php
// Création de la navigation
  $nav = new navigation();


 ?>
<header>
  <h1><?=$title?></h1>
  <h2><?=$title2?></h2>
  <?php
  if(isset($_SESSION['role'])) {
    $nav->affichageNav($_SESSION['role'], 0);
  } else {
    $nav->affichageNav(0, 0);
  }
   ?>
</header>
