<?php
Class Navigation {
  private $navigation;
  private $routeForm;
  private $navigationBas;
  public function __construct(){
    $this->navigation = [
      ['cheminNav'=>'Modules/pageIndex.php', 'nom'=>'Accueil', 'droit'=>0, 'bas'=>0],
      ['cheminNav'=>'Modules/securiter/inscription.php', 'nom'=>'Inscription', 'droit'=>0, 'bas'=>0 ],
      ['cheminNav'=>'Modules/securiter/connexion.php', 'nom'=>'Connexion', 'droit'=>0, 'bas'=>0],
      ['cheminNav'=>'Modules/utilisateur/profil.php', 'nom'=>'Profil', 'droit'=>1, 'bas'=>0],
      ['cheminNav'=>'Modules/securiter/deconnexion.php', 'nom'=>'Deconnexion', 'droit'=>1, 'bas'=>0],
      ['cheminNav'=> 'Modules/article/creer-article.php', 'nom'=>'Créer un article', 'droit'=>42, 'bas'=>0],
      ['cheminNav'=>'Modules/utilisateur/profil.php', 'nom'=>'Profil', 'droit'=>42, 'bas'=>0],
      ['cheminNav'=>'Modules/securiter/deconnexion.php', 'nom'=>'Deconnexion', 'droit'=>42, 'bas'=>0],
      ['cheminNav'=> 'Modules/administration/admin.php', 'nom'=>'Administration blog', 'droit'=>1337, 'bas'=>0],
      ['cheminNav'=> 'Modules/article/creer-article.php', 'nom'=>'Créer un article', 'droit'=>1337, 'bas'=>0],
      ['cheminNav'=>'Modules/utilisateur/profil.php', 'nom'=>'Profil', 'droit'=>1337, 'bas'=>0],
      ['cheminNav'=>'Modules/securiter/deconnexion.php', 'nom'=>'Deconnexion', 'droit'=>1337, 'bas'=>0],
      ['cheminNav'=>'Modules/article/allArticle.php', 'nom'=>'Tous les articles', 'droit'=>0, 'bas'=>1],
      ['cheminNav'=>'Modules/article/allArticle.php', 'nom'=>'Tous les articles', 'droit'=>1, 'bas'=>1],
      ['cheminNav'=>'Modules/article/allArticle.php', 'nom'=>'Tous les articles', 'droit'=>42, 'bas'=>1],
      ['cheminNav'=>'Modules/article/allArticle.php', 'nom'=>'Tous les articles', 'droit'=>1337, 'bas'=>1],
      ['cheminNav'=>'Modules/administration/modifierArticle.php', 'nom'=>'Modifier Article', 'droit'=>1337, 'bas'=>2],
      ['cheminNav'=>'Modules/article/article.php', 'nom'=>'One Article', 'droit'=>0, 'bas'=>2],];

    $this->routeForm = [
      ['route'=>'Modules/utilisateur/CUD/Create/createUser.php', 'securite'=>0],
      ['route'=>'Modules/securiter/identification.php', 'securite'=>0],
      ['route'=>'Modules/utilisateur/CUD/Update/updateProfil.php','securite'=>1],
      ['route'=>'Modules/utilisateur/CUD/Update/updateProfil.php','securite'=>42],
      ['route'=>'Modules/utilisateur/CUD/Update/updateProfil.php','securite'=>1337],
      ['route'=>'Modules/administration/CUD/Update/updateUtilisateur.php','securite'=>1337],
      ['route'=>'Modules/administration/CUD/Delete/delUser.php','securite'=>1337],
      ['route'=>'Modules/administration/CUD/Delete/delUser.php','securite'=>1],
      ['route'=>'Modules/article/CUD/Create/categorie.php','securite'=>42],
      ['route'=>'Modules/article/CUD/Create/categorie.php','securite'=>1337],
      ['route'=>'Modules/article/CUD/Create/newArticle.php','securite'=>42],
      ['route'=>'Modules/article/CUD/Create/newArticle.php','securite'=>1337],
      ['route'=>'Modules/administration/CUD/Update/modArticle.php','securite'=>1337],
      ['route'=>'Modules/administration/CUD/Delete/DeleteArticle.php','securite'=>1337],
      ];
  }

  public function affichageNav($droit, $zone) {
    //$zone 0 haut, 1 bas =>lier à 'bas' dans le tableau navigation
    echo '<nav>';
      echo '<ul>';
        for ($i=0; $i < count($this->navigation)  ; $i++) {
           if(($this->navigation[$i]['droit'] == $droit)&&($this->navigation[$i]['bas'] == $zone)) {
               echo '<li><a class="lienNav" href="index.php?idNav='.$i.'">'.$this->navigation[$i]['nom'].'</a></li>';
           }
        }
      echo'</ul>';
    echo'</nav>';
  }
  public function trouverChemin($idNav, $session) {
    if(($session != [])&&($session['role'] == $this->navigation[$idNav]['droit'])) {
      return $this->navigation[$idNav]['cheminNav'];
    } else {
        if($this->navigation[$idNav]['droit'] == 0) {
          return $this->navigation[$idNav]['cheminNav'];
        } else {
          return $this->navigation[0]['cheminNav'];
        }
    }
  }
  public function trouverRouteForm($index) {
    return $this->routeForm[$index]['route'];
  }
  public function routeFormInterne($index) {
    return $this->routeForm[$index];
  }
}
