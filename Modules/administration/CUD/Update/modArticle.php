<?php
$idNav = filter($_POST['idNav']);
array_pop($_POST);
//Contrôle
$ok = array();
array_push($ok, champsVide($_POST));
$sizeChamps = [80, 6500, 5];
$champs = ['titre', 'article', 'id_categorie'];
for ($i=0; $i < count($sizeChamps) ; $i++) {
  array_push($ok, sizePost($_POST[$champs[$i]], $sizeChamps[$i]) );
}
// Vérification que la catégorie soit bien référencer.
$select = "SELECT `id` FROM `categories` WHERE`id` = :id_categorie";
$param = [['prep'=>':id_categorie', 'variable'=>filter($_POST['id_categorie'])]];
$verification = new RCUD($select, $param);
$data = $verification->READ();
if($data = []) {
  array_push($ok, 1);
} else {
  array_push($ok, 0);
}
// Génération du tableau
$verif = generationTable (5);
if($ok == $verif) {
// Update de l'article
$param = [['prep'=>':titre', 'variable'=>filter($_POST['titre'])],
          ['prep'=>':article', 'variable'=>filterTexte($_POST['article'])],
          ['prep'=>':id', 'variable'=>filter($_POST['id'])],
          ['prep'=>':id_categorie', 'variable'=>filter($_POST['id_categorie'])]];
$updateArticle = "UPDATE `articles`
SET `titre`=:titre,`article`=:article,`id_categorie`=:id_categorie WHERE `id` = :id";
$action = new RCUD($updateArticle, $param);
$action->CUD();
  header('location:../index.php?message=Article modifié.&idNav='.$idNav.'&id='.filter($_POST['id']));
} else {
  header('location:../index.php?message=Champs vide ou taille de texte incorrecte.');
}
