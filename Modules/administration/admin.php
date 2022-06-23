<?php
// Administration des utilisateurs
  include 'Modules/utilisateur/objets/getUser.php';
  include 'Modules/utilisateur/objets/printUser.php';
  include 'functions/functionPagination.php';
  $Utilisateurs = new PrintUser();
  // Paramètre de pagination
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
  $currentPage = 1;
  }
  $parPage = 5;
  echo '<h3 class="titre">Panneau d\'administration des utilisateurs page : '.$currentPage.'</h3>';
  // Compter le nombre d'entrée `utilisateurs`
  $count = "SELECT COUNT(`id`) AS `nbr` FROM `utilisateurs`";
  $void = array();
  $countUtilisateur = new RCUD($count, $void);
  $nbr = $countUtilisateur->READ();
  $nbrUtilisateur = $nbr[0]['nbr'];
  $pages = ceil($nbrUtilisateur/$parPage);
  $premier = ($currentPage * $parPage) - $parPage;
  $select = "SELECT `utilisateurs`.`id`, `login`, `email`, `id_droits`, `nom`, `token`
            FROM `utilisateurs`
            INNER JOIN `droits` ON `droits`.`Id` = `utilisateurs`.`id_droits`
            ORDER BY `id_droits` LIMIT {$premier}, {$parPage}";
  $readUtilisateurs = new RCUD($select, $void);
  $dataTraiter = $readUtilisateurs->READ();
  $Utilisateurs->administrationUtilisateur($dataTraiter, $idNav, $nav);
 for ($page=1; $page <= $pages ; $page++ ) {
   echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
 }
 //Administration des catégories
$chemin = 'Modules/article/objets/';
include $chemin.'getArticles.php';
include $chemin.'printArticles.php';
$readTitreArticles = new PrintArticles();
$dataTraiter = $readTitreArticles->AllTitresArticles();
echo '<h3 class="titre">Liste des articles du blog trié par catérogie et date</h3>';
$readTitreArticles->affichageTitreArticle ($dataTraiter);
?>
