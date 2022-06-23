<?php
$idNav = filter($_POST['idNav']);
array_pop($_POST);
$verificationDroit = filter($_POST['id_droits']);
// Vérification que les droits sont correctes
if(($verificationDroit == 1)||($verificationDroit == 42)||($verificationDroit == 1337)) {
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $update = "UPDATE `utilisateurs` SET `id_droits`= :id_droits WHERE `id` = :id AND `token` = :token";
  $action = new RCUD($update, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav);
} else {
  header('location:../index.php?idNav=3');
}
