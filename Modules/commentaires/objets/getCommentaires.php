<?php
Class GetCommentaires {
  private $idArticle;
  public function __construct($id) {
    $this->idArticle = $id;
  }
  public function readCommentaire() {
    $param = [['prep'=>':id_article', 'variable'=>$this->idArticle]];
    $select = "SELECT `commentaires`.`id`, `commentaire`, `id_article`, `commentaires`.`id_utilisateur`, `date`, `login`
    FROM `commentaires`
    INNER JOIN `utilisateurs` ON `utilisateurs`.`id` = `commentaires`.`id_utilisateur`
    WHERE `id_article` = :id_article
    ORDER BY `date` DESC";
    $readCommentaires = new RCUD($select, $param);
    return $readCommentaires->READ();
  }
}
