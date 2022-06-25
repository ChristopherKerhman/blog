<?php
$chemin = 'Modules/article/objets/';
require $chemin.'getArticles.php';
require $chemin.'printArticles.php';
include 'functions/formFunction.php';
$dataCategorie = new PrintArticles();
$categories = $dataCategorie->getCataegoriesArticles();
if($_SESSION['role'] == 42) {
  $index = 10;
}
if($_SESSION['role'] == 1337) {
  $index = 11;
}

 ?>
<h3 class="titre">Créer un article</h3>
<!--Présentation outils de présentation de texte.-->
<script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>
<!--Présentation outils de présentation de texte.-->
<form class="formulaire" action="formCommun/formStandard.php?index=<?=$index?>" method="post">
  <label for="titre">Titre de votre article</label>
  <input id="titre" type="text" name="titre" required>
  <label for="article">Votre article :</label>
  <textarea id="article" name="article" rows="8" cols="80" required>
  </textarea>
  <?php $dataCategorie->selectCategorie($categories, 0); ?>
  <button class="buttonForm" type="submit" name="idNav" value="6">Publier</button>
</form>

<h3 class="titre">Ajouter une nouvelle catégorie d'article ?</h3>
<?php
$variable = [['name'=>'nom', 'message'=>'Nouvelle catégorie', 'type'=>0]];
$button = 'Ajouter';
if($_SESSION['role'] == 42) {

  formAction('formCommun/formStandard.php?index=8', $variable, $idNav, $button);
}
if($_SESSION['role'] == 1337) {
  formAction('formCommun/formStandard.php?index=9', $variable, $idNav, $button);
}
$dataCategorie->listeCategorie ($categories);
 ?>
