<?php
// Recherche Id pour modifier le token de session
$param = [['prep'=>':token', 'variable'=>$_SESSION['token']]];
$select = "SELECT `id` FROM `utilisateurs` WHERE `token` = :token";
$idUser = new RCUD($select, $param);
$id = $idUser->READ();
$update = "UPDATE `utilisateurs` SET `token`=:token WHERE `id` = :id";
$param = [['prep'=>':token', 'variable'=>genToken (14)], ['prep'=>':id', 'variable'=>$id[0]['id']]];
$action = new RCUD($update, $param);
$action->CUD();
// Le token a changé impossible de réutiliser l'ancienne $_SESSION
session_destroy();
$_SESSION = array();
header('location:index.php?message=Vous êtes déconnecté');
