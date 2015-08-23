<?php

/**
 * Fichier : NOTE.CLASS.PHP
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
class Note extends Item {

    private $_note;
    private $_idNote;

    public function setNote($note) {
        $this->_note = $note;
    }

    public function setIdNote($idNote) {
        $this->_idNote = $idNote;
    }

    public function getNote() {
        return $this->_note;
    }

    public function getIdNote() {
        return $this->_idNote;
    }

    public function add($note) {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $note = $this->getNote();
        $sql = "INSERT INTO _notes (idUser,idItem,note) VALUES (" . $idUser . "," . $idItem . "," . $note . ")";
        $res = mysql_runsql($sql);
    }

    public function update($note) {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $note = $this->getNote();
        $sql = "UPDATE _notes SET note=" . $note . " WHERE idUser=" . $idUser . " AND idItem=" . $idItem;
        $res = mysql_runsql($sql);
    }

    public function average() {
        $idItem = $this->getId();
        $sql = "SELECT AVG(note) as moyenne FROM _notes WHERE idItem=" . $idItem . " AND enable=1";
        $res = mysql_runsql($sql);
        if (mysql_num_rows($res) > 0) {
            $val = mysql_fetch_object($res);
            return intval($val->moyenne);
        } else {
            return 1;
        }
    }

    public function myNote($idUser) {
        $idItem = $this->getId();
        $sql = "SELECT IF(COUNT(*)>0,note,0) FROM _notes WHERE idItem=" . $idItem . " AND idUser=" . $idUser . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        return $val[0];
    }

    public function count() {
        $idItem = $this->getId();
        $sql = "SELECT COUNT(*) FROM _notes WHERE idItem=" . $idItem . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        return $val[0];
    }

    public function exist() {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $sql = "SELECT IF(COUNT(*)>0,'true','false') FROM _notes WHERE idUser=" . $idUser . " AND idItem=" . $idItem . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        if (strcmp($val[0], "true") == 0) {
            return true;
        } else {
            return false;
        }
    }

}
