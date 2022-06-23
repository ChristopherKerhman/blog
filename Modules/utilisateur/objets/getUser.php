<?php
Class GetUser {
  public function GetUserProfil($token) {
    $select = "SELECT `login`, `password`, `email`, `nom`, `utilisateurs`.`id`, `utilisateurs`.`id_droits`, `token`
    FROM `utilisateurs`
    INNER JOIN `droits` ON `id_droits` = `droits`.`Id`
    WHERE `token` = :token";
    $param = [['prep'=>':token', 'variable'=>$token]];
    $user = new RCUD($select, $param);
    return $user->READ();
  }
  public function GetAllUser() {
    $select ="SELECT `utilisateurs`.`id`, `login`, `email`, `id_droits`, `token`, `nom`
    FROM `utilisateurs`
    INNER JOIN `droits` ON `id_droits` = `droits`.`Id`
    ORDER BY `utilisateurs`.`id_droits`";
    $void = array();
    $readUsers = new RCUD($select, $void);
    return $readUsers->READ();
  }
}
