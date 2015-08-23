<?php

/**
 * Description courte de la classe
 *
 * Description plus détaillée de la classe (si besoin en est)...
 *
 * @author     Philippe RIPAUX 	<pripaux@gmail.com>
 * @author     Pascal CHARTOIRE <cpascal4@gmail.com>
 * @copyright  2014-2015 @Home
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 *
 */
class Message {

    private $_text;

    public function setText($text) {
        $this->_text = $text;
    }

    public function getText() {
        return $this->_text;
    }

    public function error() {
        return "<div class='error'>" . $this->getText() . "<div>";
    }

    public function warning() {
        return "<div class='warning'>" . $this->getText() . "<div>";
    }

    public function info() {
        return "<div class='info'>" . $this->getText() . "<div>";
    }

    public function success() {
        return "<div class='success'>" . $this->getText() . "<div>";
    }

}
