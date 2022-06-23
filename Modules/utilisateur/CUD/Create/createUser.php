<?php

include '../../../../objets/objetsGeneraux.php';
include '../../../../functions/fonctionsDB.php';
$message = ['Email valide', 'Email invalide'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$ok = array();
// Controle champs vide
array_push($ok, champsVide($_POST));

$idNav = filter($_POST['idNav']);
$emailOk = isValidEmail(filter($_POST['email']));
//Contrôle des doublon de mail
$doublonEmail = new Controles ();

$arrayControleDoublon = [
['sql'=>'SELECT  `email` FROM `utilisateurs` WHERE `email` = :email', 'preparation'=>':email', 'valeur'=>filter($_POST['email'])],
['sql'=>'SELECT `login` FROM `utilisateurs` WHERE `login` = :login', 'preparation'=>':login', 'valeur'=>filter($_POST['login'])]];
$ok = array();
foreach ($arrayControleDoublon as $key => $value) {
array_push($ok, $doublonEmail->doublon($value['sql'], $value['preparation'] , $value['valeur']));
}
if((filter($_POST['motDePasse']) == filter($_POST['password']))&&($emailOk == true) &&($ok == [0, 0])) {
  // Suppression des éléments inutile
  array_shift($_POST);
  array_pop($_POST);
  $_POST['password'] = haschage(filter($_POST['password']));
  //Creation du tokenId
  $_POST['token'] = genToken(16);
  // cryptage mot de passe
  $parametre = new Preparation ();
  $param = $parametre->creationPrep ($_POST);
} else {
  print_r($ok);
  header('location:../../../../index.php?message=Champs vide, mail, login ou mot de passe invalide');
}
$insert = "INSERT INTO `utilisateurs`(`login`, `password`, `email`, `token`)
VALUES (:login, :password, :email, :token)";
$action = new RCUD($insert, $param);
$action->CUD();

header('location:../../../../index.php?message=Compte créer&idNav='.$idNav);

} else {
  header('location:../../../../index.php');
}
