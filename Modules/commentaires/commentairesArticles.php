<?php

// Adressage selon les droits
if($_SESSION['role'] == 1) {
  $index = 14;
}
if($_SESSION['role'] == 42) {
  $index = 15;
}
if($_SESSION['role'] == 1337) {
  $index = 16;
}
?>
<form class="formulaire" action="formCommun/formStandard.php?index=<?=$index?>" method="post">
  <label for="commentaire">Votre commentaire</label>
  <textarea name="commentaire" rows="8" cols="80" placeholder="Votre commentaire <?=$_SESSION['login']?>"></textarea>
  <input type="hidden" name="id_article" value="<?=$idArticle?>">
  <input type="hidden" name="id_utilisateur" value="<?=$_SESSION['token']?>">
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter commentaire</button>
</form>
