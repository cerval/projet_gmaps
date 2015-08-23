<?php

/**
 * Fichier : USER.CLASS.PHP
 *
 * Description :
 * Plus détaillée de la classe (si besoin en est)...
 *
 * @author     Philippe RIPAUX 	<pripaux@gmail.com>
 * @author     Pascal CHARTOIRE <cpascal4@gmail.com>
 * @copyright  2014-2015 @Home
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 *
 */
class User {

    private $_id;
    private $_login;
    private $_passwd;
    private $_email;
    private $_categories;

    public function setId($id) {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int) $id;
        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->_id = $id;
        }
    }

    public function setLogin($login) {
        $this->_login = $login;
    }

    public function setPasswd($passwd) {
        $this->_passwd = $passwd;
    }

    public function setEmail($mail) {
        $this->_email = $mail;
    }

    public function setCategories($categories) {
        $this->_categories = $categories;
    }

    public function getId() {
        return $this->_id;
    }

    public function getLogin() {
        return $this->_login;
    }

    public function getPasswd() {
        return $this->_passwd;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getCategories() {
        return $this->_categories;
    }

    public function create() {

        $sql = "INSERT INTO ";
        $sql .= " _users ( ";
        $sql .= "		login , ";
        $sql .= "		passwd , ";
        $sql .= "		mail , ";
        $sql .= "		categories , ";
        $sql .= "		created , ";
        $sql .= "		enable ";
        $sql .= " )  VALUES ( ";
        $sql .= "		'" . $this->getLogin() . "',  ";
        $sql .= "       '" . $this->getPasswd() . "' ,  ";
        $sql .= "		'" . $this->getEmail() . "',  ";
        $sql .= "		'" . $this->getCategories() . "',  ";
        $sql .= "		CURRENT_TIMESTAMP ,  ";
        $sql .= "		'1' ";
        $sql .= ")";
        mysql_runsql($sql);
        echo "0";
        //}
    }

    public function update() {
        // Exécute une requête INSERT() et retourne l'id de l'item inséré.
        $sql = "UPDATE _users SET login = '" . $this->getLogin() . "' WHERE id = " . $this->getId();
        return $sql;
    }

    /**
     * [login description]
     * @param  [string] $login   [le login utilisateur de connexion au site]
     * @param  [string] $passwd  [le mot de passe crypter en sha1]
     * @return [integer]         [La valeur de retour afin de permettre de faire nos vérifications en javascript par la suite]
     */
    public function login($login, $passwd) {

        // Set session variables
        $sql = "SELECT id, login, categories, traffic, maptype, enable FROM _users WHERE passwd='" . $passwd . "' AND login='" . $login . "'";
        //echo $sql;
        $res = mysql_runsql($sql);
        $val = mysql_fetch_object($res);

        if (mysql_num_rows($res) > 0) {
            $_SESSION["sid"] = session_id();
            $_SESSION["id"] = $val->id;
            $_SESSION["login"] = $val->login;
            $_SESSION["categories"] = $val->categories;
            $_SESSION["traffic"] = $val->traffic;
            $_SESSION["maptype"] = $val->maptype;
            $_SESSION["enable"] = $val->enable;
            return true; //echo "Variables de sessions définies.";
        } else {
            return false; //echo "Nom ou mot de passe invalide...";
        }
    }

    public function isEnable($login) {
        $sql = "SELECT IF(enable>0,'true','false')enable FROM _users WHERE login='" . $login . "'";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        if (strcmp($val[0], "true") == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_unset(); //@session_unset(); // remove all session variables
        session_destroy(); // Détruit toutes les variables de session
        return true;
    }

    public function exist() {
        $sql = "SELECT IF(COUNT(*)>0,'true','false') FROM _users WHERE login='" . $this->getLogin() . "' OR mail='" . $this->getEmail() . "'";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        if (strcmp($val[0], "true") == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getObjectVars() {
        var_dump(get_object_vars($this));
    }

}
