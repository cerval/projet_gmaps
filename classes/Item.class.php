<?php

/**
 * Fichier : ITEM.CLASS.PHP
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
class Item {

    private $_id;
    private $_title;
    private $_categorie;
    private $_latitude;
    private $_longitude;
    private $_comment;

    /*     * ***********************************************************************
     * Getter
     * *********************************************************************** */

    public function getId() {
        return $this->_id;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getCategorie() {
        return $this->_categorie;
    }

    public function getLatitude() {
        return $this->_latitude;
    }

    public function getLongitude() {
        return $this->_longitude;
    }

    public function getComment() {
        return $this->_comment;
    }

    /*     * **********************************************************************
     * Setter
     * ********************************************************************** */

    public function setId($id) {
        //if (!is_int($id)) { // S'il ne s'agit pas d'un nombre entier.
        //    trigger_error("L'id transmis n'est pas un entier", E_USER_WARNING);
        //    return;
        // }
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        //$id = (int) $id;
        // On vérifie ensuite si ce nombre est bien strictement positif.
        // if ($id > 0) {
        // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
        $this->_id = $id;
        //}
    }

    public function setTitle($title) {
        $this->_title = $title;
    }

    public function setCategorie($categorie) {
        $this->_categorie = $categorie;
    }

    public function setLatitude($latitude) {
        $this->_latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->_longitude = $longitude;
    }

    public function setComment($comment) {
        $this->_comment = $comment;
    }

    /*     * **********************************************************************
     * Fonctions principales
     * ********************************************************************** */

    public function create() {
        // Exécute une requête INSERT() et retourne l'id de l'item inséré.

        $sql = "INSERT INTO _items ( ";
        $sql .= "           idUser, ";
        $sql .= "           idCategorie, ";
        $sql .= "           title, ";
        $sql .= "           description, ";
        $sql .= "           latitude, ";
        $sql .= "           longitude, ";
        $sql .= "           created, ";
        $sql .= "           enable ";
        $sql .= " ) VALUES ( ";
        $sql .= "           '" . $_SESSION['id'] . "', ";
        $sql .= "           '" . $this->getCategorie() . "', ";
        $sql .= "           '" . $this->getTitle() . "', ";
        $sql .= "           '" . $this->getComment() . "', ";
        $sql .= "           '" . $this->getLatitude() . "', ";
        $sql .= "           '" . $this->getLongitude() . "', ";
        $sql .= "           CURRENT_TIMESTAMP , ";
        $sql .= "           '1'";
        $sql .= " )";
        //echo $sql;        
        mysql_runsql($sql);
        return true;
        //$sql = "INSERT INTO _items (iID, iTitle, iComment) VALUES (".$objItem->getId().", '".$objItem->getTitle()."', '".$objItem->getComment()."' )";
        //return $sql;
    }

    /*     * ***********************************************************************
     * Fonctions globales
     * *********************************************************************** */

    /**
     * [countAll description]
     * @return integer 	Compte toutes les entrées de la base de données
     */
    public function countAll() {
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        $sql = "SELECT COUNT(*) as count FROM _items";
        $res = mysql_runsql($sql);
        $val = mysql_fetch_row($res);
        return $val[0];
    }

    public function getObjectVars() {
        var_dump(get_object_vars($this));
    }

    public function template($objNote, $type) {
        ?>
        <div id="reference" class="refItems">
            <div id="refItemHeader">
                <div id="refItemHeaderTitle">
                    <img src="images/maps/<?php echo rtvIconByCategoriesID($this->getCategorie()); ?>" width="20" />
                    &nbsp;
                    <span class="itemTitle"><?php echo $this->getTitle(); ?></span>
                </div>
                <div id="refItemHeaderUserAndDate">
                    <?php
                    echo "<img src='images/star-" . $objNote->average() . ".png' border='0' />";
                    ?>

                </div>
            </div>

            <div id="refItemComment" style="border-left: 10px solid  <?php echo rtvColorByCategoriesID($this->getCategorie()); ?>;">
                <div id="itemcolor"></div>
                <div id="itemComment"><div id="refItemCommentText"><?php echo $this->getComment(); ?></div></div>
            </div>


            <div id="refItemFooter">

                <div data-role="navbar" data-iconpos="left">
                    <ul>
                        <?php
                        if ($type == 0) {// TOUS
                            ?>
                            <li><a href="#" data-icon="heart" data-theme="a" onclick="javascript:jsAddToBookmark(<?php echo $this->getId(); ?>)"><?php echo constant("_LNG_ADD_BOOKMARK_"); ?></a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="#" data-icon="heart" data-theme="a" onclick="javascript:jsRemoveToBookmark(<?php echo $this->getId(); ?>)"><?php echo constant("_LNG_DEL_BOOKMARK_"); ?></a></li>
                            <?php
                        }
                        ?>
                        <!--<li><a href="#" data-icon="eye">VOIR LA PAGE</a></li>-->
                        <li><a href="#bookmarksForm" data-icon="eye" data-theme="a" onclick="javascript:jsItemShow(<?php echo $this->getId(); ?>, '<?php echo $this->getLatitude(); ?>', '<?php echo $this->getLongitude(); ?>', '<?php echo rtvIconByCategoriesID($this->getCategorie()); ?>')">Voir la page</a>
                    </ul>
                </div><!-- /navbar -->
            </div>
        </div>
        <?php
    }

}

/*
for($i=1;$i<5;$i++){
	$item = new Item;
	echo $item->setId($i);
	echo $item->setTitle("Encore une victoire de canard [id: ".$item->getId()."]");
	echo $item->setComment("salut greg");

	var_dump($item);


	echo $item->add($item);
}
echo "<br>";
echo "Count total items : " . $item->countAll($item);
echo "<br>";
echo $item->getObjectVars();
*/