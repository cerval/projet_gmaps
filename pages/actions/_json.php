<?php

// Start the session
session_start();
//include_once("../../config/config.php");
//connect();
include_once("../../config/load_all.php");

$act = $_POST['act'];

switch ($act) {

    case "genMarker":

        $latitude_south = trim($_POST['latS']);
        $longitude_south = trim($_POST['lngS']);
        $latitude_north = trim($_POST['latN']);
        $longitude_north = trim($_POST['lngN']);
        $categories = $_SESSION["categories"];
        /*
          From Google: ( (a, b), (c, d) )
          SELECT * FROM tilistings WHERE lat > a AND lat < c AND lng > b AND lng < d
          SELECT * FROM tilistings WHERE lat BETWEEN a AND c AND lng between b AND  d
         */

        $sql = "SELECT * FROM _items ";
        $sql .= " WHERE latitude BETWEEN " . $latitude_south . " AND " . $latitude_north . " ";
        $sql .= " AND longitude BETWEEN " . $longitude_south . " AND " . $longitude_north . " ";
        $sql .= " AND idCategorie IN ( " . $categories . " ) ";
        $sql .= " AND enable=1";
        /*
          echo "<br>";
          echo $sql;
          echo "<br>";
         */
        $res = mysql_runsql($sql);

        if (mysql_num_rows($res) == 0) { // Si pas de résultats on génère un array vide
            $markers[] = Array(
                "id" => null,
                "user" => null,
                "icon" => null,
                "title" => null,
                "description" => null,
                "latitude" => null,
                "longitude" => null,
                "created" => null
            );
        } else { // Sinon on boucle sur les entrées
            //while ($markers = mysql_fetch_assoc($res)) {
            while ($val = mysql_fetch_object($res)) {
                $markers[] = Array(
                    "id" => $val->id,
                    "user" => $val->idUser,
                    "icon" => rtvIconByCategoriesID($val->idCategorie),
                    "title" => utf8_encode($val->title),
                    "description" => utf8_encode($val->description),
                    "latitude" => $val->latitude,
                    "longitude" => $val->longitude,
                    "created" => $val->created
                );
            }
        }

        echo json_encode($markers);
        //var_dump($markers);
        break;

    case "selCategories";

        $idCategorie = $_POST['cat'];

        $sql = "SELECT  id, name, color, icon ";
        $sql .= "FROM _categories WHERE id=" . $idCategorie;
        $res = mysql_runsql($sql);
        //val = mysql_fetch_assoc($res);
        //echo json_encode($val);

        while ($val = mysql_fetch_object($res)) {
            $categories[] = Array(
                "id" => $val->id,
                "name" => constant($val->name),
                "color" => $val->color,
                "icon" => $val->icon
            );
        }
        echo json_encode($categories);
        break;
}

@close();
