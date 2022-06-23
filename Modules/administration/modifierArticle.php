<?php
$chemin = 'Modules/article/objets/';
require $chemin.'getArticles.php';
require $chemin.'printArticles.php';
$dataUnArticle = new PrintArticles ();
$idArticle = filter($_GET['id']);
$dataTraiter = $dataUnArticle->GetUnArticle($idArticle);
$dataUnArticle->modArticle($dataTraiter, $idNav);
 ?>
