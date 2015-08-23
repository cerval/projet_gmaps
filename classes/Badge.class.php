<?php

/**
 * Fichier : BADGE.CLASS.PHP
 *
 * Description :
 * plus détaillée de la classe (si besoin en est)...
 *
 * @author     Philippe RIPAUX 	<pripaux@gmail.com>
 * @author     Pascal CHARTOIRE <cpascal4@gmail.com>
 * @copyright  2014-2015 @Home
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 *
 */
class Badge extends Comment {

    private $_type;
    private $_idComment;

    public function setType($type) {
        $this->_type = $type;
    }

    public function setIdComment($idComment) {
        $this->_idComment = $idComment;
    }

    public function getType() {
        return $this->_type;
    }

    public function getIdComment() {
        return $this->_idComment;
    }

    public function addBadge() {
        $idUser = $_SESSION['id'];
        $idComment = $this->getIdComment();
        $type = $this->getType();
        $sql = "INSERT INTO _badges (idUser, idComment, type ) VALUES ('" . $idUser . "',  '" . $idComment . "',  '" . $type . "')";
        $res = mysql_runsql($sql);
    }

    public function updateBadge() {
        $idUser = $_SESSION['id'];
        $idComment = $this->getIdComment();
        $type = $this->getType();
        $sql = "UPDATE _badges SET type = '" . $type . "' WHERE idComment=" . $idComment . " AND idUser=" . $idUser;
        $res = mysql_runsql($sql);
    }

    public function showBadge($type) {
        $idComment = $this->getIdComment();
        $sql = "SELECT count(*) FROM _badges WHERE idComment=" . $idComment . " AND type='" . $type . "' AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        return $val[0];
    }

    public function existBadge() {
        $idUser = $_SESSION['id'];
        $idComment = $this->getIdComment();
        $type = $this->getType();
        $sql = "SELECT IF(COUNT(*)>0,'true','false') FROM _badges WHERE idComment=" . $idComment . " AND idUser=" . $idUser . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        if (strcmp($val[0], "true") == 0) {
            return true;
        } else {
            return false;
        }
    }

}
