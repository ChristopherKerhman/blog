<?php
session_start();
$title = 'S-B-M';
$title2 = 'Simple Blog Machine';
$css = 'css/master.css';
// Création du meta description dynamique
$selectD = "SELECT `titre`
FROM `articles` LIMIT 20";
$paramDescription = array();
$dataDescription = new RCUD($selectD, $paramDescription);
$dataD = $dataDescription->READ();
$description = NULL;
foreach ($dataD as $key => $value) {
  $description = $value['titre'].', '.$description;
}

 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$description?>">
    <meta name="Cache-Control" content="max-age=31536000">
    <link rel="stylesheet" href="<?=$css?>">
    <title><?=$title?></title>
  </head>
  <body>
