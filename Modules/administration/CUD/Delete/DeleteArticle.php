<?php
$delete = "DELETE FROM `articles` WHERE `id` = :id";
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$delArticle = new RCUD($delete, $param);
$delArticle->CUD();
header('location:../index.php?message=Article supprimé');
