<?php
function brassageDate($data) {
$date = $data;
$year = substr($date,0,4);
$month = substr($date,5,2);
$day = substr($date,8,2);
$date = $day.'/'.$month.'/'.$year;
return $date;
}
function dateHeure($data) {
  $date = $data;
  $year = substr($date,0,4);
  $month = substr($date,5,2);
  $day = substr($date,8,2);
  $heure = substr($date,11,2);
  $minute = substr($date,14,2);
  $date = $day.'/'.$month.'/'.$year.' - '.$heure.'H'.$minute;
  return $date;
}
