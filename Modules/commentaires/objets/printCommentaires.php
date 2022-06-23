<?php

Class PrintCommentaires extends GetCommentaires {
public function affichageCommentaires ($variable) {
  foreach ($variable as $key => $value) {
    echo '<ul class="profilBox commentaires">';
      echo '<li>Le '.brassageDate($value['date']).' - '.dateHeure($value['date']).' Auteur '.$value['login'].'</li>';
      echo '<li>'.$value['commentaire'].'</li>';
    echo '</ul>';
  }
}
}
