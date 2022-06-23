<?php
  $chemin = 'Modules/article/objets/';
  require $chemin.'getArticles.php';
  require $chemin.'printArticles.php';
  include 'functions/functionPagination.php';
  $allArticles = new PrintArticles();
 ?>
<form class="formulaire" id="messagePrint"  action="<?php filter($_SERVER["PHP_SELF"]); ?>" method="post">
  <?php
    $dataCat = $allArticles->getCataegoriesArticles();
    $allArticles->selectCategorie($dataCat);
   ?>
  <button class="buttonForm" type="submit" name="button">Tri ?</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['tri'] = filter($_POST['id_categorie']);
  if(!isset($_SESSION['role'])) {
    $_SESSION['role'] = 0;
  }
}
if(isset($_GET['start']) && (!empty($_GET['start']))) {
  $currentPage = filter($_GET['start']);
} else {
$currentPage = 1;
}
$parPage = 5;
  echo '<h3 class="titre">Tous les articles | page : '.$currentPage.'</h3>';
  if(isset(  $_SESSION['tri'])) {
    $count = "SELECT COUNT(`id`) AS `nbr` FROM `articles` WHERE `id_categorie` = {$_SESSION['tri']}";
  } else {
    $count = "SELECT COUNT(`id`) AS `nbr` FROM `articles`";
  }

$void = array();
$countArticles = new RCUD($count, $void);
$nbr = $countArticles->READ();
$nbrArticles = $nbr[0]['nbr'];
$pages = ceil($nbrArticles/$parPage);
$premier = ($currentPage * $parPage) - $parPage;
if(isset(  $_SESSION['tri'])) {
  $select = "SELECT `articles`.`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`, `login`, `nom`
  FROM `articles`
  INNER JOIN `categories`ON `categories`.`id` = `articles`.`id_categorie`
  INNER JOIN `utilisateurs` ON `utilisateurs`.`id` = `articles`.`id_utilisateur`
  WHERE `id_categorie` = :id_categorie
  ORDER BY `id_categorie`, `date` LIMIT {$premier}, {$parPage}";
  $void = [['prep'=>':id_categorie', 'variable'=>$_SESSION['tri']]];
} else {
  $select = "SELECT `articles`.`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`, `login`, `nom`
  FROM `articles`
  INNER JOIN `categories`ON `categories`.`id` = `articles`.`id_categorie`
  INNER JOIN `utilisateurs` ON `utilisateurs`.`id` = `articles`.`id_utilisateur`
  ORDER BY `id_categorie`, `date` LIMIT {$premier}, {$parPage}";
}

$readArticles = new RCUD($select, $void);
$dataTraiter = $readArticles->READ();
$allArticles->affichageArticlePagination($dataTraiter);
for ($page=1; $page <= $pages ; $page++ ) {
  echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&start='.$page.'">'.$page.'</a>';
}
?>
