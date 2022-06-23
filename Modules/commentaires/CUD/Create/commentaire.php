<?php
$idNav = filter($_POST['idNav']);
array_pop($_POST);
$ok = array();
// Controle champs vide & taille du champs
array_push($ok, champsVide($_POST));
array_push($ok, sizePost(filter($_POST['commentaire']), 1024));
if($ok == [0, 0]) {
// Trouver id de l'utilisateur
  $select = "SELECT `id` FROM `utilisateurs` WHERE `token` = :token";
  $param = [['prep'=>':token', 'variable'=>$_SESSION['token']]];
  $trouverId = new RCUD($select, $param);
  $id = $trouverId->READ();
  $_POST['id_utilisateur'] = $id[0]['id'];
//Création des paramètres d'enregistrement du commentaire
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
// Enregistrement commentaires
  $insert = "INSERT INTO `commentaires`(`commentaire`, `id_article`, `id_utilisateur`)
  VALUES (:commentaire, :id_article, :id_utilisateur)";
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&id='.filter($_POST['id_article']).'&message=Commentaire vide ou trop long');
} else {
  header('location:../index.php?idNav='.$idNav.'&id='.filter($_POST['id_article']).'&message=Commentaire vide ou trop long');
}
