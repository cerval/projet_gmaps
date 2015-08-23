<?php
/**
 * Fichier : LOAD_ALL.PHP
 *
 * Description : 
 * Chargement de tous les fichiers requis au fonctionnement du site. 
 *
 * @author     Philippe RIPAUX 	<pripaux@gmail.com>
 * @author     Pascal CHARTOIRE <cpascal4@gmail.com>
 * @copyright  2014-2015 @Home
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 *
 */

// Definie les différentes constantes du projet
define("_CFG_PATH_APP_", $_SERVER['DOCUMENT_ROOT']."/projet_gmaps");

/* CONFIG */
include_once(constant("_CFG_PATH_APP_")."/config/config.php");

/* LANGUE */
$browserLanguage = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
if (file_exists(constant("_CFG_PATH_APP_")."/langues/" . $browserLanguage[1] . ".php")) {
    include_once(constant("_CFG_PATH_APP_")."/langues/" . $browserLanguage[1] . ".php"); // chargement de la langue personnalisée
} else {
    include_once(constant("_CFG_PATH_APP_")."/langues/fr.php"); // chargement de la langue par défaut
}

/* CONSTANTES */
include_once(constant("_CFG_PATH_APP_")."/config/constantes.php");

/* FONCTIONS */
require_once(constant("_CFG_PATH_APP_")."/config/functions.php");

/* CLASSES */
/* Chargement des classes principales */
require_once(constant("_CFG_PATH_APP_")."/classes/Item.class.php");
require_once(constant("_CFG_PATH_APP_")."/classes/Message.class.php");
require_once(constant("_CFG_PATH_APP_")."/classes/User.class.php");
/* Chargement des extensions de classes */
require_once(constant("_CFG_PATH_APP_")."/classes/Comment.class.php");	
require_once(constant("_CFG_PATH_APP_")."/classes/Note.class.php");		// Extends Item.class
require_once(constant("_CFG_PATH_APP_")."/classes/Badge.class.php");	// Extends Comment.class

?>