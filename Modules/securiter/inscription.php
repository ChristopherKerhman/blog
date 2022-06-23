<h3 class="titre">Inscription au blog</h3>
<?php
include 'functions/formFunction.php';
$variable = [['name'=>'motDePasse', 'message'=>'Votre mot de passe', 'type'=>9],
                    ['name'=>'password', 'message'=>'Confirmer votre mot de passe', 'type'=>9],
                    ['name'=>'login', 'message'=>'Votre login', 'type'=>0],
                    ['name'=>'email', 'message'=>'Votre email', 'type'=>0],];
$button = 'Inscription';
$idNav = 2;

formAction($nav->trouverRouteForm(0), $variable, $idNav, $button);
