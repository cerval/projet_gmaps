<?php
// Start the session
session_start();
//include_once("../../config/config.php");
//connect();
include_once("../../config/load_all.php");

$act = $_POST['act'];

switch ($act) {

    case "login":
      $login = $_POST['log'];
      $passwd = $_POST['pwd'];
      $objUser = new User;

      if ($objUser->isEnable($login) == true) {
          if ($objUser->login($login, $passwd)) {
              echo 0; // Connexion OK
          } else {
              echo 1; // Connexion KO
          }
      } else {
          echo 2; // Nom d'utilisateur et/ou mot de passe non reconnu
      }
    break;

    case "logout":
      $objUser = new User;
      if ($objUser->logout()) {
          echo 0;
      }
    break;

    case "create":
      $login = $_POST['log'];
      $passwd = $_POST['pwd'];
      $mail = $_POST['mail'];

      $categories = "";
      // ON récupère les types de références active et on les insère par défaut comme active dans les options de l'utilisateur
      $sql = "SELECT id FROM _categories WHERE parent!=0 AND enable=1";
      $res = mysql_query($sql);

      while ($val = mysql_fetch_object($res)) {
          $categories .= $val->id . ","; // Concaténation des valeurs stockés dans un seul champ
      }
      $categories = substr($categories, 0, -1); // On supprime le dernier caractère de la chaine " , "
      //$categories = "2,3";
      $objUser = new User;
      $objUser->setLogin($login);
      $objUser->setPasswd($passwd);
      $objUser->setEmail($mail);
      $objUser->setCategories($categories);

      //$objUser->getObjectVars();
      if (!$objUser->exist()) {
          echo $objUser->create();
      }
    break;

    case "addItem":

      $categorie = trim($_POST['cat']);
      $latitude = trim($_POST['lat']);
      $longitude = trim($_POST['lng']);
      $title = addslashes(trim($_POST['ttl']));
      $comment = addslashes(trim($_POST['com']));

      // On remplis notre objet Item
      $objItem = new Item;
      $objItem->setTitle($title);
      $objItem->setCategorie($categorie);
      $objItem->setLatitude($latitude);
      $objItem->setLongitude($longitude);
      $objItem->setComment($comment);

      $objMessage = new Message;
      if ($objItem->create($objItem)) {
          $objMessage->setText("Insertion réussie de '" . $objItem->getTitle() . "'");
          echo $objMessage->success();
      } else {
          $objMessage->setText("Echec à l'insertion de  '" . $objItem->getTitle() . "'");
          echo $objMessage->error();
      }

    break;

    case "updateCategories":

      $categories = trim($_POST['cat']);
      $traffic = trim($_POST['trf']);
      $maptype = trim($_POST['map']);

      $sql = "UPDATE _users SET ";
      $sql .= "categories = '" . $categories . "',  ";
      $sql .= "traffic = '" . $traffic . "',  ";
      $sql .= "maptype = '" . $maptype . "'  ";
      $sql .= " WHERE id = " . $_SESSION['id'];
      mysql_runsql($sql);
      //echo $sql;
      //
		  $_SESSION["categories"] = $categories;
      $_SESSION["traffic"] = $traffic;
      $_SESSION["maptype"] = $maptype;

      $objMessage = new Message;
      //if($objItem->create($objItem)){
      $objMessage->setText("Mise à jour réussie");
      echo $objMessage->success();
      //}else{
      //	$objMessage->setText("Echec de la mise à jour");
      //	echo $objMessage->error();
      //}

    break;

    case "addBookmark":

      $idItem = $_POST['item'];
      $objMessage = new Message;

      $sel = "SELECT id FROM _bookmarks WHERE idItem='" . $idItem . "' AND idUser='" . $_SESSION['id'] . "'";
      $res = mysql_runsql($sel);
      if (mysql_num_rows($res) == 0) {

        $sql = "INSERT INTO _bookmarks ( ";
        $sql .= "           idItem, ";
        $sql .= "           idUser ";
        $sql .= " ) VALUES ( ";
        $sql .= "           '" . $idItem . "', ";
        $sql .= "           '" . $_SESSION['id'] . "' ";
        $sql .= " )";
        mysql_runsql($sql);

        $objMessage->setText("Favoris ajouté");
        echo $objMessage->success();
        //echo $sql;
        //echo 0;
      } else {
        //echo 1;
        $objMessage->setText("Favoris déjà présent");
        echo $objMessage->warning();
      }

    break;

    case "loadItems":

      $nbItems = 10;
      $limit = trim($_POST['page']);
      $type = trim($_POST['type']);
      $limitItems = ($limit * $nbItems);
      $next = ($limit + 1);

      // $arrColor = Array("white", "red", "orange", "yellow", "blue", "green");



      if ($type == 0) { // ALL ITEMS
        $sql = "SELECT * FROM _items 
                WHERE enable=1 
                AND idCategorie IN (" . $_SESSION['categories'] . ") 
                ORDER BY created DESC 
                LIMIT " . $limitItems . ", " . $nbItems;
      } else {        // ONLY BOOKMARKS
        $sql = "SELECT * FROM _items, _bookmarks 
                WHERE _bookmarks.idItem=_items.id 
                AND _bookmarks.idUser='" . $_SESSION['id'] . "' 
                AND _bookmarks.enable=1 AND _items.enable=1
                ORDER BY _bookmarks.created DESC 
                LIMIT " . $limitItems . ", " . $nbItems;
      }

      //echo $sql;
      $res = mysql_runsql($sql);
      while ($val = mysql_fetch_object($res)) {
        /*
          echo $val->rUserID . "&nbsp;";
          echo $val->rTypeID . "&nbsp;";
          echo $val->rTitle . "&nbsp;";
          echo $val->rComment . "&nbsp;";
          echo $val->rLatitude . "&nbsp;";
          echo $val->rLongitude . "&nbsp;";
          echo $val->rCreated . "<br><br>";
         */
        $date = date_create($val->created);

        $idItem = (int) $val->id;
        $objNote = new Note;
        $objNote->setId($idItem);
        //$moyenne = $objNote->average();

        $objItem = new Item;
        $objItem->setId($val->id);
        $objItem->setTitle($val->title);
        $objItem->setCategorie($val->idCategorie);
        $objItem->setLatitude($val->latitude);
        $objItem->setLongitude($val->longitude);
        $objItem->setComment($val->description);

        $objItem->template($objNote,$type);
      }

      echo "<br>";

      if ($type == 0) {// TOUS
        echo "<div id='itemsAllContent_" . ($next) . "'><a href='#' onclick='javascript:jsLoadItems(" . $next . ", " . $type . ");'  data-role='button' data-icon='recycle' data-mini='true' data-theme='c'>Charger les prochains items</a></div>";
      } else {// ONLY BOOKMARKS
        echo "<div id='itemsMyContent_" . ($next) . "'><a href='#' onclick='javascript:jsLoadItems(" . $next . ", " . $type . ");'  data-role='button' data-icon='recycle' data-mini='true' data-theme='c'>Charger les prochains favoris</a></div>";
      }
    break;

    case "loadDetails":
      $idItem = $_POST['item'];
      $sql = "SELECT * FROM _items WHERE id='" . $idItem . "'";
      //echo $sql;
      $res = mysql_runsql($sql);
      $val = mysql_fetch_object($res);
      $date = date_create($val->created);
      ?>

      <div id="refItemHeader">
        <div id="refItemHeaderTitle">
          <img src="images/maps/<?php echo rtvIconByCategoriesID($val->idCategorie); ?>" width="20" />
          &nbsp;
          <span class="itemTitle"><?php echo $val->title; ?></span>
        </div>
        <div id="refItemHeaderUserAndDate">
          <span style="margin-top:2px;"><img src="images/status_online.png" /></span>&nbsp;<?php echo rtvLoginByID($val->idUser); ?>&nbsp;
          <span style=""><img src="images/calendar.png" /></span>&nbsp;<?php echo date_format($date, constant("_LNG_DATE_FORMAT_")); ?>
        </div>
      </div>
      <br>
      <div id="itemDescription"><?php echo $val->description; ?></div>

      <div id="itemSponsorised"><?php echo $val->description; ?> / sponsorisé</div>
      <br>
      <div><b>Position :</b> (Latitude: <?php echo $val->latitude; ?>, Longitude: <?php echo $val->longitude; ?>)</div>
      <?php
    break;

    case "loadAverageNote":
      $idItem = (int) $_POST['item'];
      $objNote = new Note;
      $objNote->setId($idItem);
      $moyenne = $objNote->average();

      echo "<img src='images/star-".$moyenne.".png' border='0' />";

    break;

    case "loadMyNote":
      $idItem = (int) $_POST['item'];
      $objNote = new Note;
      $objNote->setId($idItem);
      $myNote = $objNote->myNote($_SESSION['id']);
      //echo "Ma note = ".$myNote."<br>";
     // $arrColor = Array("white", "red", "orange", "yellow", "blue", "green");
      ?>
      Note <p id="rating-onchange-value" style="display:inline;"></p> :
      <div id="jRate_myNote"></div>
      <script type="text/javascript">

          $('#rating-onchange-value').text(<?php echo $myNote; ?> + " / 5");
          $("#jRate_myNote").jRate({
              rating: <?php echo $myNote; ?>,
              startColor: 'blue',
              endColor: 'blue',
              width: 50,
              height: 50,
              precision: 0,
              count: 5,
              onChange: function (rating) {
                  $('#rating-onchange-value').text(rating + " / 5");
              },
              onSet: function (rating) {
                  //$('#demo-onset-value').text("Selected Rating: "+rating);
                  //alert("ma note saisie: " + rating);
                  jsAddMyComment();
                  jsAddMyNote(rating);
              }
          });
      </script> 
      <?php
    break;

    case "loadAllComments":

      $idItem = $_POST['item'];
      $idUser = $_SESSION['id'];
      $idType = $_POST['type']; // 0 = myComment / 1 = allComment
      // $arrColor = Array("white", "red", "orange", "yellow", "blue", "green");
      if($idType==0){
       $sql = "SELECT * FROM _comments WHERE idItem=" . $idItem . " AND idUser=" . $idUser ;
      }
      if($idType==1){
       $sql = "SELECT * FROM _comments WHERE idItem=" . $idItem . " AND idUser!=" . $idUser ;
      }
      //echo $sql;
      $res = mysql_runsql($sql);
      if(mysql_num_rows($res)>0){
        $val = mysql_fetch_object($res);

        $date = date_create($val->created);
        
        //$idItem = (int) $idItem;
        $objComment = new Comment;
        $objComment->setId($idItem);
        $objComment->setIdComment($val->id);
        $objComment->setIdUser($val->idUser);
        $objComment->setText($val->comment);
        $objComment->setDate($date);

        $objBadge = new Badge;
        $objBadge->setIdComment($val->id);

        $objNote = new Note;
        $objNote->setId($idItem);
        //$myNote = $objNote->myNote($val->idUser);

        $objComment->template($objNote, $objBadge);
        ?>


        <?php
        }else{
          echo constant("_LNG_NO_COMMENTS_");
        }
    break;

  case "addMyComment":
    $idItem = $_POST['item'];
    $text = $_POST['text'];

    $objComment = new Comment;
    $objComment->setId($idItem);
    $objComment->setText($text);

    $objMessage = new Message;

    if ($objComment->exist()) {
        $objComment->update();
        $objMessage->setText(constant("_LNG_UPDATE_SUCCESS_"));
    } else {
        $objComment->add();
        $objMessage->setText(constant("_LNG_ADD_SUCCESS_"));
    }
    echo $objMessage->success();

  break;

  case "addMyNote":
    $idItem = $_POST['item'];
    $note = $_POST['note'];

    $objNote = new Note;
    $objNote->setId($idItem);
    $objNote->setNote($note);

    $objMessage = new Message;

    if ($objNote->exist()) {
        $objNote->update();
        $objMessage->setText(constant("_LNG_UPDATE_SUCCESS_"));
    } else {
        $objNote->add();
        $objMessage->setText(constant("_LNG_ADD_SUCCESS_"));
    }
    echo $objMessage->success();

  break;

  case "updateBadge":
    $idComment = $_POST['comment'];
    $type = $_POST['type'];

    $objBadge = new Badge;
    $objBadge->setType($type);
    $objBadge->setIdComment($idComment);

    //$objComment->setId($idItem);
    if(!$objBadge->existBadge()){
      $objBadge->addBadge(); 
    }else{
      $objBadge->updateBadge(); 
    }

    echo $objBadge->showBadge($type);        
  break;
}

@close();