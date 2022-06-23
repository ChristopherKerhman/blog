<?php
$idNav = filter($_POST['idNav']);
array_pop($_POST);
// Vérification de l'autorisation de supprimer le compte
$select = "SELECT `id_droits` FROM `utilisateurs`
          WHERE `id` = :id AND `token` = :token";
          $parametre = new Preparation();
          $param = $parametre->creationPrep ($_POST);
$readDroit = new RCUD($select, $param);
$droit = $readDroit->READ();
if($droit[0]['id_droits'] == 1) {
  // Suppression définitive du compte
  $delete = "DELETE FROM `utilisateurs` WHERE `token` = :token AND `id`=:id";
  $action =new RCUD($delete, $param);
  $action->CUD();
  header('location:../index.php?message=Erreur de traitement&idNav='.$idNav);
} else {
  header('location:../index.php?message=Le compte a des droits trop haut pour être supprimé&idNav='.$idNav);
}
