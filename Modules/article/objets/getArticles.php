<?php
Class GetArticles {
  public function getCataegoriesArticles () {
    $select = "SELECT `id`, `nom` FROM `categories` ";
    $void = array();
    $readCategorie = new RCUD($select, $void);
    return $readCategorie->READ();
  }
  public function AllTitresArticles() {
    $select = "SELECT `articles`.`id`, `titre`, `id_utilisateur`, `id_categorie`, `date`, `nom`, `login`
    FROM `articles`
    INNER JOIN `utilisateurs` ON `utilisateurs`.`id` = `articles`.`id_utilisateur`
    INNER JOIN `categories` ON `categories`.`id` = `articles`.`id_categorie`
    ORDER BY `id_categorie`, `date`";
    $void = [];
    $readAllArticles = new RCUD($select, $void);
    return $readAllArticles->READ();
  }
  public function GetUnArticle($id) {
    $select = "SELECT `articles`.`id`, `titre`, `id_utilisateur`, `id_categorie`, `date`, `nom`, `login`, `article`
                FROM `articles`
                INNER JOIN `utilisateurs` ON `utilisateurs`.`id` = `articles`.`id_utilisateur`
                INNER JOIN `categories` ON `categories`.`id` = `articles`.`id_categorie`
                WHERE `articles`.`id` = :id";
    $param = [['prep'=>':id', 'variable'=>$id]];
    $readUnArticle = new RCUD($select, $param);
    return $readUnArticle->READ();
  }
}
