<?php
session_start();
include '../functions/fonctionsDB.php';
include '../objets/objetsGeneraux.php';
$index = filter($_GET['index']);
$route =  new Navigation();
$dataRoute = $route->routeFormInterne($index);
// Vérification de sécurité
if(($_SESSION['role'] == $dataRoute['securite'])&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
  //routeur 
include '../'.$dataRoute['route'];


} else {
    header('location:../index.php?idNav=3');
}
