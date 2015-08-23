<?php 
include_once("config.php");
connect();

function mysql_runsql($sql) {
	return mysql_query($sql);
}

function rtvIconByCategoriesID($idCategorie){
	$sql = "SELECT icon FROM _categories WHERE id=".$idCategorie;
	$res = mysql_runsql($sql);
	$val = mysql_fetch_object($res);
	return $val->icon;
}

/**
 * [rtvColorByCategoriesID description]
 * @param  integer 	$iCategoriesID 		id de la cat�gorie rattach� � l'item
 * @return string 	le code couleur 	ex:FF0000
 */
function rtvColorByCategoriesID($idCategorie){
	$sql = "SELECT color FROM _categories WHERE id=".$idCategorie;
	$res = mysql_runsql($sql);
	$val = mysql_fetch_object($res);
	return $val->color;
}

function rtvLoginByID($idUser){
	$sql = "SELECT login FROM _users WHERE id=".$idUser;
	$res = mysql_runsql($sql);
	$val = mysql_fetch_object($res);
	return $val->login;
}

function formatPositionForBDD($myPosition){
	$myPosition = str_replace("(","",$myPosition);
	$myPosition = str_replace(")","",$myPosition);
	$myPosition = trim($myPosition);
	return $myPosition;
}

function sub_text($text, $size = 30) {
	if (strlen($text) > $size) {
		$text = substr($text, 0, ($size - strlen($text)) - 3) . "...";
	}
	return $text;
}

function format_bytes($size) {
	$units = array(' B', ' KB', ' MB', ' GB', ' TB');
	for ($i = 0; $size >= 1024 && $i < 4; $i++)
		$size /= 1024;
	return round($size, 2) . $units[$i];
}

function dateBetwinDate($dateCheck, $dateDeb, $DateFin) {

	$check_ts = strtotime($dateCheck);
	$deb_ts = strtotime(preg_replace("/(\d+)\D+(\d+)\D+(\d+)/", "$3-$2-$1", $dateDeb));
	$fin_ts = strtotime(preg_replace("/(\d+)\D+(\d+)\D+(\d+)/", "$3-$2-$1", $DateFin));

	if ($check_ts >= $deb_ts && $check_ts <= $fin_ts) {
		return 1;
	} else {
		return 0;
	}
}

function nbJours($debut, $fin) {
	//60 secondes X 60 minutes X 24 heures dans une journ�e
	$nbSecondes = 60 * 60 * 24;

	$debut_ts = strtotime($debut);
	$fin_ts = strtotime($fin);
	$diff = $fin_ts - $debut_ts;
	return round($diff / $nbSecondes);
}



@close();
?>