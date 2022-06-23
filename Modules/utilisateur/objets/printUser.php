<?php
Class PrintUser extends GetUser {
  public function profilUser ($data){
    echo '<div class="profilBox">';
      echo '<ul>';
        echo '<li>'.$data[0]['login'].'</li>';
        echo '<li>'.$data[0]['email'].'</li>';
        echo '<li>'.$data[0]['nom'].'</li>';
      echo'</ul>';
      if($data[0]['id_droits'] == 1){
echo '<form action="formCommun/formStandard.php?index=7" method="post">
      <input type="hidden" name="id" value="'.$data[0]['id'].'" />
      <input type="hidden" name="token" value="'.$data[0]['token'].'" />
      <button class="buttonForm" type="submit" name="idNav" value="3">Suppression du compte</button>
      </form>';
    }
    echo '</div>';
  }
  public function modProfilUser($data){
    echo '
    <form class="formulaire" action="formCommun/formStandard.php?index=2" method="post">
    <label for="motDePasse">Votre mot de passe</label>
    <input id="motDePasse" type="password" name="motDePasse" placeholder="Votre nouveau mot de passe" required>
    <label for="password">Confirmer votre mot de passe</label>
    <input id="password" type="password" name="password" placeholder="Votre nouveau mot de passe" required>
    <label for="login">Votre login</label>
    <input id="login" type="text" name="login" value="'.$data[0]['login'].'" required>
    <label for="email" >Votre email</label>
    <input id="email" type="text" name="email"value="'.$data[0]['email'].'" required>
    <button class="buttonForm" type="submit" name="idNav" value="3">Modifier</button>
    </form>';
  }
  public function administrationUtilisateur($variable, $idNav, $nav) {
    // Récupération des types de droits
    $select = "SELECT `Id`, `nom` FROM `droits`";
    $void = array();
    $readDroits = new RCUD($select, $void);
    $dataDroits = $readDroits->READ();

    echo '<ul class="tableau">';
    foreach ($variable as $key => $value) {
        echo '<li class="flex-row">
        <div class="profilBox flex-row">

        <form  action="formCommun/formStandard.php?index=5" method="post">
        <label for="id_droits">Modifier le droit de : '.$value['login'].'</label>
        <select id="id_droits" name="id_droits">';
          foreach ($dataDroits as $cle => $valeur) {
            if($valeur['Id'] == $value['id_droits']) {
              echo '<option value="'.$valeur['Id'].'" selected>'.$valeur['nom'].'</option>';
            } else {
              echo '<option value="'.$valeur['Id'].'">'.$valeur['nom'].'</option>';
            }
          }
        echo '</select>
        <input type="hidden" name="id" value="'.$value['id'].'" />
        <input type="hidden" name="token" value="'.$value['token'].'" />
        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
        </form>';
        if($value['id_droits'] == 1){
        echo'<form action="formCommun/formStandard.php?index=6" method="post">
          <input type="hidden" name="id" value="'.$value['id'].'" />
          <input type="hidden" name="token" value="'.$value['token'].'" />
          <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Supprimer</button>
        </form>
        </div>'; } else { echo '</div>';}

        echo'Type de droit actuel : '.$value['nom'].' | Email : '.$value['email'].'
        </li>';
    }
    echo'</ul>';
  }
}
