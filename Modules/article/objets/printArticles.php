<?php
include 'functions/functionDateTime.php';
Class PrintArticles extends GetArticles {
  public function listeCategorie ($variable) {
    if( $variable == []) {
      echo '<p>Pas encore de catégorie.</p>';
    } else {
    echo '<ul>';
      foreach ($variable as $key => $value) {
        echo '<li>'.$value['nom'].'</li>';
      }
    echo'</ul>';
    }
  }
  public function selectCategorie($variable) {
    echo '<lable for="id_categorie">Catégorie de votre article ?</lable>';
    echo '<select id="id_categorie" name="id_categorie">';
      foreach ($variable as $key => $value) {
        echo '<option value="'.$value['id'].'">'.$value['nom'].'</option>';
      }
    echo'</select>';
  }
  public function affichageTitreArticle ($variable) {
    echo '<ul>';
    foreach ($variable as $key => $value) {
      echo '<li class="profilBox"><a class="lienNav" href="index.php?idNav=17&id='.$value['id'].'">Modifier</a> Auteur : '.$value['login'].' | titre article '.$value['titre'].' | catégorie '.$value['nom'].' | date '.brassageDate($value['date']).'</li>';
    }
    echo '</ul>';
  }
  public function modArticle($data, $idNav) {
    $categories = new PrintArticles ();
    $dataCat = $categories->getCataegoriesArticles ();
    echo '<!--Présentation outils de présentation de texte.-->
    <script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>
    <!--Présentation outils de présentation de texte.-->
    <form class="formulaire" action="formCommun/formStandard.php?index=12" method="post">
      <label for="titre">Titre de votre article</label>
      <input id="titre" type="text" name="titre" value="'.$data[0]['titre'].'" required>
      <label for="article">Votre article :</label>
      <textarea id="article" name="article" rows="8" cols="80" required>'.$data[0]['article'].'</textarea>';
      $categories->selectCategorie($dataCat);

  echo'<input type="hidden" name="id" value="'.$data[0]['id'].'" />
      <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
    </form>';
  echo '<form class="formulaire" action="formCommun/formStandard.php?index=13" method="post">
      <input type="hidden" name="id" value="'.$data[0]['id'].'" />
      <button class="buttonForm" type="submit">Supprimer</button>
      </form>' ;
  }
  public function affichageArticlePagination($variable) {
    echo '<ul>';
    foreach ($variable as $key => $value) {
      echo '<li class="profilBox"><a class="lienNav" href="index.php?idNav=6&id='.$value['id'].'">Afficher</a> Auteur : '.$value['login'].' | titre article '.$value['titre'].' | catégorie '.$value['nom'].' | date '.brassageDate($value['date']).'</li>';
    }
    echo '</ul>';
  }
}
