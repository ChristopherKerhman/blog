<?php
$idNav = filter($_POST['idNav']);
array_pop($_POST);
$ok = array();
// Controle champs vide & taille du champs
array_push($ok, champsVide($_POST));
array_push($ok, sizePost(filter($_POST['nom']), 80));
if($ok == [0, 0]) {
  $insert = "INSERT INTO `categories`(`nom`) VALUES (:nom)";
  $parametre = new Preparation();
  $param =   $parametre->creationPrep ($_POST);
  $action = new RCUD($insert, $param);
  $action->CUD();
header('location:../index.php?message=Nouvelle catégorie enregistrée&idNav='.$idNav);

} else {
  header('location:../index.php?message=Champs vide ou trop long&idNav='.$idNav);
}
