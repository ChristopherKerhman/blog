<?php
session_start();
include '../../objets/objetsGeneraux.php';
include '../../functions/fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  array_pop($_POST);
// Vérification de l'identité de l'utilisateur
$select = "SELECT `login`, `password`, `id_droits`, `token` FROM `utilisateurs` WHERE `login` = :login";
$param = [['prep'=>':login', 'variable'=>filter($_POST['login'])]];
$readLogin = new RCUD($select, $param);
$dataID = $readLogin->READ();
if(password_verify(filter($_POST['password']), $dataID[0]['password'])) {
  // Création de la session
  $_SESSION['login'] = $dataID[0]['login'];
  $_SESSION['role'] = $dataID[0]['id_droits'];
  $_SESSION['token'] = $dataID[0]['token'];
  header('location:../../index.php?message=Bienvenu '.$login.'&idNav='.$idNav);
} else {
  header('location:../../index.php?message=Erreur de mot de passe ou de login&idNav='.$idNav);
}


} else {
  header('location:../../index.php?message=Erreur de traitement');
}
