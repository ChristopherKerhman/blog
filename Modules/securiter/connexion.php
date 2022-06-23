<h3 class="titre">Connexion</h3>
<?php
include 'functions/formFunction.php';
$variable = [['name'=>'login', 'message'=>'Votre login', 'type'=>0],
            ['name'=>'password', 'message'=>'Mot de passe', 'type'=>9]];
$button = 'Connexion';
$idNav = 0;
$route = 'Modules/securiter/identification.php';
formAction($nav->trouverRouteForm(1), $variable, $idNav, $button);
