<?php
$chemin = 'Modules/article/objets/';
require $chemin.'getArticles.php';
require $chemin.'printArticles.php';
$dernierArticles = new PrintArticles();
$data = $dernierArticles->troisArticles();
$dernierArticles->troisArticlesComplet($data);
