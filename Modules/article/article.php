<?php
$chemin = 'Modules/article/objets/';
require $chemin.'getArticles.php';
require $chemin.'printArticles.php';
$dataUnArticle = new PrintArticles ();
$idArticle = filter($_GET['id']);
$dataTraiter = $dataUnArticle->GetUnArticle($idArticle);
$dataUnArticle->AfficherUnArticle ($dataTraiter);
if((isset($_SESSION['role']))&&(($_SESSION['role']==1)||($_SESSION['role']==42)||($_SESSION['role']==1337))) {
include 'Modules/commentaires/commentairesArticles.php';
}
  if(!isset($_SESSION['role'])) { echo '<p>Ajouter un commentaire ? Créer un compte.</p>'; }
  $cheminCom = 'Modules/commentaires/objets/';
  require $cheminCom.'getCommentaires.php';
  require $cheminCom.'printCommentaires.php';
  $commentaires = new PrintCommentaires($idArticle);
  $commentairesArticle = $commentaires->readCommentaire();
  $commentaires->affichageCommentaires ($commentairesArticle);
