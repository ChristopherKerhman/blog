<?php
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function filterTexte($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}

function haschage($data) {
  $option = ['cost' => 10];
  $data = password_hash($data, PASSWORD_BCRYPT, $option);
  return $data;
}
function champsVide($data) {
  $ok = 0;
  foreach ($data as $key => $value) {
    if ($value === '') {
        $ok = 1;
    }
  }
  return $ok;
}
function sizePost($data, $size) {
  if(strlen($data) <= $size) {
    return 0;
  } else {
    return 1;
  }
}
function borneSelect($data, $maxArray) {
  if(($data >=0)||($data<=$maxArray)) {
    return 0;
  } else {
    return 1;
  }
}
function generationTable ($size) {
  $array = array();
  for ($i=0; $i < $size; $i++) {
    array_push($array, 0);
  }
  return $array;
}

function genToken ($size) {
    $alpha = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i=0; $i < 3 ; $i++) {
        $alpha = str_shuffle($alpha).$alpha;
    }
    $token = NULL;
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = rand(0, strlen($alpha));
      $letter = substr($alpha, $number, 1);
      $token = $token.$letter;
      //$token =  $token.substr($alpha, rand(0,strlen($alpha)));
    }
    return $token;
}
function isValidEmail($str) {
    $regex = '/^(\w+)+\.?(\w+)+@(\w+)+\.\w{2,}$/';
    if (preg_match($regex, $str)) {
        return true;
    } else {
        return false;
    }
}
