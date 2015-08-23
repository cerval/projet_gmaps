<?php

/**
 * Fichier : SQLPDO.CLASS.PHP
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
class SqlPDO {

    private function db_connect($PORT) {
        try {
            $dbcon = new PDO('mysql:host=' . DBHOST . ';port=' . $PORT . ';dbname=' . DBNAME, DBUSER, DBPWD, array(PDO::ATTR_PERSISTENT => false));
        } catch (PDOException $e) {
            $message = "Date : " . date("Y-m-d H:i:s", time()) . "<br/>";
            $message.="Error : " . $e->getMessage() . "<br/>";
            $message.="Host : " . DBHOST . "<br/>";
            $message.="DB : " . DBNAME . "<br/>";
            @mail(EMAILADMIN, "ERROR SQL CON " . $PORT, $message);
            die();
        }
        return $dbcon;
    }

    public function db_update($sql, $comment) {
        $dbup = db_connect(PORT2);
        $stmt = $dbup->prepare($sql);
        $stmt->execute();
        if ($dbup->errorCode() <> '00000') {
            $error_array = $dbup->errorInfo();
            $message = "Request : " . $sql . "\n";
            $message.="SQLSTATE : " . $error_array[0] . "\n";
            $message.="Mysql Error Code : " . $error_array[1] . "\n";
            $message.="Message : " . $error_array[2] . "\n";
            @mail(EMAILADMIN, "ERROR SQL REQ - " . $comment, $message);
        }
    }

    public function db_insert($sql, $comment) {
        $dbup = db_connect(PORT1);
        $stmt = $dbup->prepare($sql);
        $stmt->execute();
        if ($dbup->errorCode() <> '00000') {
            $error_array = $dbup->errorInfo();
            $message = "Request : " . $sql . "\n";
            $message.="SQLSTATE : " . $error_array[0] . "\n";
            $message.="Mysql Error Code : " . $error_array[1] . "\n";
            $message.="Message : " . $error_array[2] . "\n";
            @mail(EMAILADMIN, "ERROR SQL REQ - " . $comment, $message);
        }
    }

    public function mysql_runsql($sql) {
        return mysql_query($sql);
    }

}
