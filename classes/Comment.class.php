<?php

/**
 * Fichier : COMMENT.CLASS.PHP
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
class Comment {
    /************************************************************************
     * COMMENTAIRES 
     ************************************************************************/

    private $_id;
    private $_text;
    private $_idComment;
    private $_idUser;
    private $_date;

    /************************************************************************
     * Getter
     ************************************************************************/

    public function getId() {
      return $this->_id;
    }
    public function getText() {
      return $this->_text;
    }
    public function getIdComment() {
      return $this->_idComment;
    }
    public function getIdUser() {
      return $this->_idUser;
    }
    public function getDate() {
      return $this->_date;
    }

    /************************************************************************
     * Getter
     ************************************************************************/
    public function setId($id) {
        $this->_id = $id;
    }
    public function setText($text) {
        $this->_text = $text;
    }
   public function setIdComment($idComment) {
        $this->_idComment = $idComment;
    }
   public function setIdUser($idUser) {
        $this->_idUser = $idUser;
    }   
    public function setDate($date) {
      $this->_date = $date;
    }    
    /************************************************************************
     * Functions
     ************************************************************************/

    public function add() {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $comment = htmlspecialchars($this->getText(), ENT_QUOTES);
        $sql = "INSERT INTO _comments (idUser,idItem,comment) VALUES (" . $idUser . "," . $idItem . ",'" . $comment . "')";
        $res = mysql_runsql($sql);        
    }

    public function update() {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $comment = htmlspecialchars($this->getText(), ENT_QUOTES);
        $sql = "UPDATE _comments SET comment='" . $comment . "' WHERE idUser=" . $idUser . " AND idItem=" . $idItem;
        $res = mysql_runsql($sql);        
    }

    /*
      public function delete() {
      $idUser = $_SESSION['id'];
      $idItem = $this->getId();
      }
     */
    
    public function count() {
        $idItem = $this->getId();
        $sql = "SELECT COUNT(*) FROM _comments WHERE idItem=" . $idItem . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        return $val[0];
    }

    public function exist() {
        $idUser = $_SESSION['id'];
        $idItem = $this->getId();
        $sql = "SELECT IF(COUNT(*)>0,'true','false') FROM _comments WHERE idUser=" . $idUser . " AND idItem=" . $idItem . " AND enable=1";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        if(strcmp($val[0],"true")==0){
            return true;
        }else{
            return false;
        }
    }

  public function template($objNote, $objBadge){
    
    ?>
    <div id="reference" class="refItems">

        <div id="refItemHeader">
            <div id="refItemHeaderTitle">
              <span style="margin-top:2px;"><img src="images/status_online.png" /></span>&nbsp;<?php echo rtvLoginByID($this->getIdUser()); ?>&nbsp;
              <span style=""><img src="images/calendar.png" /></span>&nbsp;<?php echo date_format($this->getDate(), constant("_LNG_DATE_FORMAT_")); ?>                
            </div>
            <div id="refItemHeaderUserAndDate">
                <?php
                echo "<img src='images/star-".$objNote->myNote($this->getIdUser()).".png' border='0' />";
                ?>
            </div>
        </div>

        <div id="refItemComment">
          <div id="itemComment"><div id="refItemCommentText"><?php echo $this->getText(); ?></div></div>
        </div>

        <div id="refItemFooter">
            <!-- navbar -->
            <div data-role="navbar" data-iconpos="left">
                <ul>
                  <li>
                    <a href="#" data-icon="plus" data-theme="c" onclick="javascript:jsUpdateBadge(<?php echo $this->getIdComment(); ?>,'plus');">J'aime (<p id='badge_plus_item_<?php echo $this->getIdComment(); ?>' style='display:inline;'><?php echo $objBadge->showBadge("plus"); ?></p>)</a>
                  </li>
                  <li>
                    <a href="#" data-icon="minus" data-theme="d" onclick="javascript:jsUpdateBadge(<?php echo $this->getIdComment(); ?>,'minus');">J'aime pas (<p id='badge_minus_item_<?php echo $this->getIdComment(); ?>' style='display:inline;'><?php echo $objBadge->showBadge("minus"); ?></p>)</a>
                  </li>
                </ul>
            </div>
            <!-- /navbar -->
        </div>
      </div>
    <?php
  }

}
