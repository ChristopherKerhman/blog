<?php
  $chemin = 'Modules/utilisateur/objets/';
  require $chemin.'getUser.php';
  require $chemin.'printUser.php';
    $userProfil = new PrintUser();
    $dataUser = $userProfil->GetUserProfil($_SESSION['token']);
 ?>
<h3 class="titre">Votre profil</h3>
  <div class="flex-row">
    <?php $userProfil->profilUser($dataUser);
          $userProfil->modProfilUser($dataUser);  ?>

  </div>
