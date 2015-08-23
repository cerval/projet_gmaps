<?php

/**
 * Fichier : CONFIG.PHP
 *
 * Description :
 * Ce fichier comporte toutes les valeurs et fonctions constantes 
 *
 * @author     Philippe RIPAUX 	<pripaux@gmail.com>
 * @author     Pascal CHARTOIRE <cpascal4@gmail.com>
 * @copyright  2014-2015 @Home
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 *
 */

if(strcmp($_SERVER['HTTP_HOST'],"127.0.0.1"==0) OR strcmp($_SERVER['HTTP_HOST'],"localhost"==0)){
/* * ***********************************************************************
 * HOME - LOCALHOST - PHIL
 * *********************************************************************** */
  
  $BDD_host = "127.0.0.1";   // nom du serveur
  $BDD_user = "root";    // nom d'utilisateur de connexion
  $BDD_passwd = "root";    // mot de passe de connexion
  $BDD_database = "citybook";   // nom de la base de données

/* * ***********************************************************************
 * OVH - DISTANT
 * *********************************************************************** */
}else{
  $BDD_host 		= "mysql51-83.perso";	// nom du serveur
  $BDD_user 		= "pripauxdev";			// nom d'utilisateur de connexion
  $BDD_passwd 	= "S3cur1t3";			// mot de passe de connexion
  $BDD_database 	= "pripauxdev";			// nom de la base de données
}

define("DBUSER", "root");
define("DBPWD", "root");
define("DBHOST", "127.0.0.1");
define("DBNAME", "citybook");
define("DBPORT1", "3306");
define("DBPORT2", "3306");
define("EMAILADMIN", "");

function connect() {
  global $BDD_host, $BDD_user, $BDD_passwd, $BDD_database;
  $BDD_connect = mysql_connect($BDD_host, $BDD_user, $BDD_passwd);
  mysql_select_db($BDD_database, $BDD_connect);
  return $BDD_connect;
}

function close() {
  global $BDD_connect;
  mysql_close($BDD_connect);
}

?>