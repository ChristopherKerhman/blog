<main class="main">
  <?php
    if(isset($_SESSION['login'])) {
      echo '<h3>Session de '.$_SESSION['login'].'</h3>';
    } else {
      echo '<h3>Bienvenus</h3>';
    }
  // Mode dev true / false - Affiche le chemin des pages + Ajout de menus / page dans le site.
  $dev = true;
  // Affichage message
  if (isset($_GET['message'])) {echo '<h3>'.filter($_GET['message']).'</h3>';}
  // Affichage elements
  if(isset($_GET['idNav'])) {
    $idNav = filter($_GET['idNav']);
    $chemin = $nav->trouverChemin($idNav, $_SESSION);
    if($chemin == []) {
    } else {
      if($dev) {
        echo $chemin;
      }
        include $chemin;
    }
  } else {
    $idNav = 0;
  }
?>
</main>
