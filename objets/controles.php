<?php
class Controles {
  public function doublon($sql, $preparation , $valeur) {
    /* $sql doit être une requette sql, $préparation doit prendre
    la forme :preparation et $valeur c'est la valeur du doublon à tester.*/
    $param = $param = [['prep'=>$preparation, 'variable'=>$valeur]];
    $controle = new RCUD ($sql, $param);
    $test = $controle->READ();
    $preparation = trim($preparation, ':');
    if(empty($test[0][$preparation])) {
      return 0;
    } else {
      return 1;
    }
  }
  public function age($token) {
    $select = "SELECT `bornYear` FROM `users` WHERE `token` = :token";
    $param = [['prep'=>':token', 'variable'=>$token]];
    $id = new RCUD($select, $param);
    $BY = $id->READ();
    $BY = $BY[0]['bornYear'];
    return date('Y') - $BY;
  }
  public function publicEvenement($public, $idEvenement) {
    $select = "SELECT COUNT(`idEvenement`) AS `nbr` FROM `evenements` WHERE `valide` = 1 AND `archive` = 0 AND `public` <= :public AND `idEvenement` = :idEvenement";
    $param = [['prep'=>':public', 'variable'=>$public], ['prep'=>':idEvenement', 'variable'=>$idEvenement]];
    $controle = new RCUD($select, $param);
    $nbr = $controle->READ();
    return $nbr[0]['nbr'];

  }
  public function dejaInscrit($idEvenement, $idUser) {
    $select = "SELECT `idMembre` FROM `participants` WHERE `idSeance` = :idEvenement AND `idMembre` = :idUser";
    $param = [['prep'=>'idEvenement', 'variable'=>$idEvenement], ['prep'=>':idUser', 'variable'=>$idUser]];
    $dejaInscrit = new RCUD($select, $param);
    $dataTraiter = $dejaInscrit->READ();
    if($dataTraiter == []) {
      return 0;
    } else {
      return 1;
    }
  }
  public function maxInscription ($idEvenement) {
    $nbr = "SELECT COUNT(`idParticipation`) AS `nbrInscrit` FROM `participants` WHERE `idSeance` = :idEvenement;";
          $id = [['prep'=>':idEvenement', 'variable'=>$idEvenement]];
          $calcul = new RCUD($nbr, $id);
          $participation = $calcul->READ();
              $nombre = "SELECT`nombre`FROM `evenements` WHERE `idEvenement` = :idEvenement";
              $max = new RCUD(  $nombre, $id);
              $nrbMax = $max->READ();
                  $nbrInscrit = $participation[0]['nbrInscrit'];
                  $nbrMax = $nrbMax[0]['nombre'];
                  $maximun = $nbrMax - $nbrInscrit;
                  if ($maximun > 0) {
                    return 1;
                  } else {
                    return 0;
                  }
  }
  public function tripleCriteres($data){
    array_pop($data);
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($data);
    $select = "SELECT COUNT(`idUser`) AS `nbr` FROM `users` WHERE `email` = :email AND `numeroAdherant` = :numeroAdherant AND `token`=:token";
    $verification = new RCUD($select, $param);
    $dataTraiter = $verification->READ();
    return $dataTraiter[0]['nbr'];
  }
  public Function controleId($token) {
    $param = [['prep'=>':token', 'variable'=>$token]];
    $select = "SELECT COUNT(`token`) AS `nbr` FROM `users` WHERE `token` = :token";
    $readId = new RCUD($select, $param);
    $dataTraiter = $readId->READ();
    return $dataTraiter[0]['nbr'];
  }
  public function statuts($numeroID) {
    $param = [['prep'=>':numeroAdherant', 'variable'=>$numeroID]];
    $select = "SELECT  `role` FROM `users` WHERE `numeroAdherant` = :numeroAdherant";
    $readUser = new RCUD($select, $param);
    $dataRole = $readUser->READ();
    return $dataRole[0]['role'];
  }
  public function ageUtilisation($token) {
    $param = [['prep'=>':token', 'variable'=>$token]];
    $select = "  SELECT `bornYear` FROM `users` WHERE `token` = :token";
    $readUser = new RCUD($select, $param);
    $dataBY= $readUser->READ();
    $actualYear = date('Y');
    return $actualYear - $dataBY[0]['bornYear'];
  }
  public function SelectDynamique($selectIDListe, $valeur) {
    // Le select id liste ne doit posséder q'une entrée sur sa valeur (id) sinon, le contrôle ne fonctionnera pas.
    $void = [];
    $readListe = new RCUD($selectIDListe, $void);
    $dataListe = $readListe->READ();
    $id = array();
    foreach ($dataListe as $key => $value) {
      array_push($id, implode($value));
    }
    $ok = 1;
    for ($i=0; $i < count($id) ; $i++) {
      if($id[$i] == $valeur) {
        $ok = 0;
      }
    }
    return $ok;
  }
  function __destruct() {
  }
}
