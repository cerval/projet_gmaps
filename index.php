<?php
// Start the session
session_start();
include_once("config/load_all.php");
?>
<!DOCTYPE html> 
<html> 
    <head> 
        <title><?php echo constant("_LNG_APP_TITLE_"); ?></title> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Launch Fullscreen on Mobile -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- /Launch Fullscreen on Mobile -->
        <meta name="description" content="WebApp" />
        <meta name="keywords" content="WebApp" />
        <meta name="author" content="Philippe RIPAUX" />
        <META http-equiv="CACHE-CONTROL" content="NO-CACHE">
        <META http-equiv="PRAGMA" content="NO-CACHE">
        <link rel="shortcut icon" href="../favicon.ico">

        <!-- Récupération d'un icone pour mis en place sur écran d'accueil -->
        <!-- <link rel="apple-touch-icon" href="images/icone.png" /> -->
        <link href="images/icon.png" rel="apple-touch-icon" />
        <link href="images/icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
        <link href="images/icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
        <link href="images/icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
        <link href="images/icon.png" rel="apple-touch-icon-precomposed" /> <!-- ANDROID -->
        <!-- /Récupération d'un icone pour mis en place sur écran d'accueil -->

        <!-- Load the CSS -->
        <!-- Loading jQuery - CSS -->
        <link rel="stylesheet" href="framework/jQueryMobile/1.4.4/jquery.mobile-1.4.4.min.css" />
        <link rel="stylesheet" href="framework/jQueryMobile/1.4.4/projet_gmaps.min.css" />
        <link rel="stylesheet" href="framework/jQuery/1.10.1/css/ui-lightness/jquery-ui-1.10.1.custom.css" />
        <!-- /Loading jQuery - CSS -->
        <!-- Loading Personnal - CSS -->
        <link rel="stylesheet" href="styles/myStyle.css" />
        <!-- /Loading Personnal - CSS -->
        <!-- /Load the CSS -->

        <!-- Load the google MAPS API -->
        <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>
        <!-- /Load the google MAPS API -->

        <!-- Loading jQuery - JS -->
        <!--<link rel="stylesheet" href="framework/jQueryMobile/1.4.4/jquery.mobile-1.4.4.min.css" />-->
        <!--<link rel="stylesheet" href="framework/jQuery/1.10.1/css/ui-lightness/jquery-ui-1.10.1.custom.css" />-->
        <script src="framework/jQuery/1.10.1/js/jquery-1.9.1.js"></script>
        <script src="framework/jQueryMobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
        <!-- /Loading jQuery - JS -->

        <!--<link rel="stylesheet" href="styles/myStyle.css" />-->
        <!-- Loading Personnal - JS -->
        <script src="scripts/sha1.js"></script>
        <script src="scripts/jRate.min.js"></script> 
        <script src="scripts/myJavascript.js"></script>
        <!-- /Loading Personnal - JS -->

    </head>

    <body onload="setTimeout(function(){window.scrollTo(0, 1);}, 100);"> 

        <!-- Pré-chargement des images -->
        <img src="images/icons/success.png" style="display:none" alt="" />
        <img src="images/icons/validation.png" style="display:none" alt="" />
        <img src="images/icons/warning.png" style="display:none" alt="" />
        <img src="images/icons/info.png" style="display:none" alt="" />
        <img src="images/icons/error.png" style="display:none" alt="" />
        <!-- /Pré-chargement des images -->

        <?php
        //print_r($_SESSION);
        if (!isset($_SESSION['sid'])) {
          ?>
          <!-- page : USER LOGIN FORM -->
          <div data-role="page" id="myConnexion" style="background-color:#34495e;">  
    				<?php include_once("pages/show/user_login_form.php"); ?>
    			</div>
          <!-- /page : USER LOGIN FORM -->
    			
    			<!-- Page : USER CREATE FORM -->
    			<div data-role="page" id="CreateUser" style="background-color:#34495e;">
    				<?php include_once("pages/show/user_create_form.php"); ?>
    			</div>
    			<!-- /Page : USER CREATE FORM -->
        <?php
        } else {
        ?>
            <!-- page : MAPS -->
            <div data-role="page" id="mapsForm">
                <?php include("pages/show/page_header.php"); ?>
                <?php include_once("pages/show/maps.php"); ?>
                <?php include("pages/show/page_footer.php"); ?>
            </div>
            <!-- /page : MAPS -->
            
            <!-- page : NEW_ITEM -->
            <div data-role="page" id="categoriesForm">
                <?php include_once("pages/show/categories_form.php"); ?>
            </div>
            <!-- /page : NEW_ITEM -->

            <!-- page : OPTIONS -->
            <div data-role="page" id="optionsForm">
                <?php include_once("pages/show/options.php"); ?>
            </div>
            <!-- /page : OPTIONS -->

            <!-- page : NOTES -->
            <div data-role="page" id="notesForm">
                <?php include_once("pages/show/notes.php"); ?>
            </div>
            <!-- /page : NOTES -->
            <!-- page : BOOKMARKS -->
            <div data-role="page" id="bookmarksForm">
                <?php include_once("pages/show/item_show.php"); ?>
            </div>
            <!-- /page : BOOKMARKS -->

            <?php include_once("pages/show/panel_left.php"); ?>
            <?php include_once("pages/show/panel_right.php"); ?>

            <!-- GOOGLE MAP -->
            <script type="text/javascript">

            // On charge le contenu des notes (les 5 dernières entrées de la bdd)
            jsLoadItems(0,0);
            jsLoadItems(0,1);
      			/*
      			map = new google.maps.Map(
      				  document.getElementById('myMaps'),
      				  {
      					  zoom: 11,
      					  center: new google.maps.LatLng(
      						  48.941106, 
      						  2.158431000000064
      					  ),
      					  mapTypeId: google.maps.MapTypeId.ROADMAP
      				  }
      			  );
      			*/

              // I update the marker's position and label.
              function updateMarker( marker, latitude, longitude, label ){
                 // Update the position.
                 marker.setPosition(
                     new google.maps.LatLng(
                         latitude,
                         longitude
                     )
                 );

                 // Update the title if it was provided.
                 if (label){
                     marker.setTitle( label );
                 }
              }
  
                function loadMap() {


                  // Check to see if this browser supports geolocation.
                  if (navigator.geolocation) {
                      
                      console.log("[GETCURRENTPOSITION]");
                      console.log("Géolocalisation OK : Détection des coordonnées en cours...");

                      // This is the location marker that we will be using
                      // on the map. Let's store a reference to it here so
                      // that it can be updated in several places.
                      var myPositionMarker = null;
                      
                      // Get the location of the user's browser using the
                      // native geolocation service. When we invoke this method
                      // only the first callback is requied. The second
                      // callback - the error handler - and the third
                      // argument - our configuration options - are optional.
                      navigator.geolocation.getCurrentPosition(
                          function( position ){

                            // Check to see if there is already a location.
                            // There is a bug in FireFox where this gets
                            // invoked more than once with a cahced result.
                            if (myPositionMarker){
                                return;
                            }

                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;
                            //var altitude  = position.coords.altitude; 

                            var devicePosition = new google.maps.LatLng(latitude, longitude);
                            //$('#uPosition').val(devicePosition);
                            //$('#uLatitude').val(latitude);
                            //$('#uLongitude').val(longitude);
                            $('#uLatitude').html(latitude);
                            $('#uLongitude').html(longitude);
                            // Log that this is the initial position.
                            console.log( "Position initiale détecté: " + devicePosition);                      
  
                            //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
                            //de définir des options d'affichage de notre carte
                            var mapOptions = {
                              center: devicePosition,
                              // 20 choix possibles:
                              // ===================
                              // 0 (monde) à 20 (street)
                              zoom: 16,
                              minZoom: 14,
                              maxZoom: 18,
                              disableDoubleClickZoom: true,
                              scrollwheel: true,
                              draggable: true,
                              zoomControl: false,
                              keyboardShortcuts: false,
                              panControl: false,
                              mapTypeControl: false,
                              streetViewControl: false,
                              // 4 type: 
                              // =======
                              // MapTypeId.ROADMAP displays the default road map view. This is the default map type.
                              // MapTypeId.SATELLITE displays Google Earth satellite images
                              // MapTypeId.HYBRID displays a mixture of normal and satellite views
                              // MapTypeId.TERRAIN displays a physical map based on terrain information.
                              //mapTypeId: google.maps.MapTypeId.ROADMAP
							                mapTypeId: google.maps.MapTypeId.<?php echo $_SESSION['maptype']; ?>
                            };

                            // On construit la carte
                            var map = new google.maps.Map(document.getElementById('myMaps'), mapOptions);

                            // On affiche notre position actuelle
                            myPositionMarker = new google.maps.Marker({
                                                        position: devicePosition,
                                                        map: map,
                                                        title: 'Ma position actuelle: ' + devicePosition,
                                                        icon: 'images/maps/me.png'
                                                    });     
                                                        
                                                        
                          addMarkerOnMap(map);
                                                        
                        },
                        function( error ){
                            console.log('ERREUR(' + error.code + '):\n' + error.message);
                        },
                        {
                            timeout: (5 * 1000),
                            maximumAge: (1000 * 60 * 15),
                            enableHighAccuracy: true
                        }
                      );

                      // Now tha twe have asked for the position of the user,
                      // let's watch the position to see if it updates. This
                      // can happen if the user physically moves, of if more
                      // accurate location information has been found (ex.
                      // GPS vs. IP address).
                      //
                      // NOTE: This acts much like the native setInterval(),
                      // invoking the given callback a number of times to
                      // monitor the position. As such, it returns a "timer ID"
                      // that can be used to later stop the monitoring.
                      var positionTimer = navigator.geolocation.watchPosition(
                          function( position ){

                              // Log that a newer, perhaps more accurate
                              // position has been found.
                              console.log( "[WATCHPOSITION]");
                              console.log( "Détection de nouvelles coordonnées : ("+position.coords.latitude+", "+position.coords.longitude+")" );

                              // Set the new position of the existing marker.
                              updateMarker(
                                  myPositionMarker,
                                  position.coords.latitude,
                                  position.coords.longitude,
                                  "Updated / Accurate Position"
                              );
                              //addMarkerOnMap(map);
                          },
                          function( error ){
                              console.log('ERREUR(' + error.code + '):\n' + error.message);
                          },
                          {
                              timeout: (5 * 1000),
                              maximumAge: (1000 * 60 * 15),
                              enableHighAccuracy: true
                          }
                      );

                      // If the position hasn't updated within 5 minutes, stop
                      // monitoring the position for changes.
                      setTimeout(
                          function(){
                              // Clear the position watcher.
                              navigator.geolocation.clearWatch( positionTimer );
                          },
                          (1000 * 60 * 5)
                      );

                  }else{
                    console.log("Geolocalisation KO : Erreur de geolocalisation");
                    //showMyPopup("<?php //echo constant('_LNG_ERROR_LOC_'); ?>", 1);
                  }
                }
                
                google.maps.event.addDomListener(window, 'load', loadMap);
				
                function addMarkerOnMap(map){
                   // récupération des frontières de maps à afficher
                   // On crée un event pour attendre la fin du chargement des "tiles"
                   //google.maps.event.addListener(map, 'bounds_changed', function() {
                   google.maps.event.addListener(map, 'idle', function() {

                       var boundaries = map.getBounds(16); // 16 = zoom définit pour l'application
                       var South_Lat = boundaries.getSouthWest().lat();
                       var South_Lng = boundaries.getSouthWest().lng();
                       var North_Lat = boundaries.getNorthEast().lat();
                       var North_Lng = boundaries.getNorthEast().lng();
                       console.log("Boundaries: " + boundaries);

                       // Création du JSON utilisé pour générer nos markers
                       var markers = new Array();
                       var url = "pages/actions/_json.php";
                       var value = "act=genMarker"; 
                           value += "&latS=" + South_Lat;
                           value += "&lngS=" + South_Lng;
                           value += "&latN=" + North_Lat;
                           value += "&lngN=" + North_Lng;
                       $.ajax({
                           type: 'POST',
                           async: false,
                           url: url,
                           data: value,
                           success: function(feedback) {
                               //console.log(feedback);
                               markers = jQuery.parseJSON(feedback);
                               //console.log(typeof markers);
                               console.log("Marker Array (" + markers.length + "): " + feedback);

                           }
                       });

                       /* Génération des markers autour de ma position */
                       if (markers[0].id !== null) {
                           for (var i = 0; i < markers.length; i++) {

                               var markerPosition = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
                               //console.log("Titre: "+markers[i].title+"\r\nPosition: "+mapMarkerPosition+"\r\nIcon: "+markers[i].icon+"\r\nComment: "+mapMarkerComment);			

                               var marker = new google.maps.Marker({
                                   position: markerPosition,
                                   map: map,
                                   title: markers[i].title,
                                   icon: 'images/maps/' + markers[i].icon
                               });
                               console.log(marker);

                               // process multiple info windows
                               (function(marker, i) {
                                   // add click event


                                   var contentString = '<div id="contentMarker'+markers[i].id+'">'+
                                                       '<h1 id="firstHeading" class="firstHeading">'+markers[i].title+'</h1>'+
                                                       '<div id="markerBodyContent">'+
                                                       '<p>'+markers[i].description+'.</p>'+
                                                       '<p>Position '+markerPosition+'.</p>'+
                                                       '<p>Date d\'ajout: '+markers[i].created+'</p>'+
                                                      // '<p>Voir: <a href="#bookmarksForm" onclick="javascript:jsItemShow('+markers[i].id+','+markers[i].latitude+', '+markers[i].longitude+', \''+markers[i].icon+'\')">Voir la page</a>'+
                                                       

                                                      '<div>'+
                                                      '<ul class="menuItem">'+
                                                      '<li><a href="#" style="color:#333;"  onclick="javascript:jsAddToBookmark('+markers[i].id+')"><?php echo constant("_LNG_ADD_BOOKMARK_"); ?></a></li>'+  
                                                      '<li><a href="#bookmarksForm" style="color:#333;" onclick="javascript:jsItemShow('+markers[i].id+','+markers[i].latitude+', '+markers[i].longitude+', \''+markers[i].icon+'\')"><?php echo constant("_LNG_SHOW_PAGE_"); ?></a></li>'+
                                                      '</ul>'+
                                                      '</div>'+

                                                      '</div>'+
                                                      /*
                                                      '<br>'+
                                                      '<div data-role="navbar" data-iconpos="left">'+
                                                      '<ul>'+
                                                      '<li><a href="#" data-icon="heart" data-theme="a">ADD TO FAVORITE</a></li>'+
                                                      '<li><a href="#bookmarksForm" data-icon="eye" data-theme="a">Voir la page</a></li>'+
                                                      '</ul>'+
                                                      '</div><!-- /navbar -->'+
                                                      */

                                                       '</div>';



                                   google.maps.event.addListener(marker, 'click', function() {
                                       infowindow = new google.maps.InfoWindow({
                                           //content: "<div id=''contentMarker><b>Titre:</b>" + markers[i].title + "<br><b>Commentaire:</b><br>" + markers[i].comment + "<br><b>Position</b><br>" + markerPosition + "<br><b>Crée le:</b><br>" + markers[i].created + "</div>",
                                           content:  contentString,
                                           maxWidth: 400
                                       });
                                       infowindow.open(map, marker);
                                   });
                               })(marker, i);
                               /*
                                google.maps.event.addListener(marker, 'click', function() {
                                var infowindow = new google.maps.InfoWindow({
                                content: '<div id="content">'+mapMarkerComment+'</div>',
                                maxWidth: 300
                                });
                                infowindow.open(map,marker);
                                });
                                */
                           }
                       }

                   });
				   
          <?php 
          if($_SESSION['traffic']==1){ 
          ?>
  					var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map);
          <?php } ?>
        }
                
				function refreshMyMap(){
					loadMap();
					//google.maps.event.trigger(map, 'resize');
				}


          var directionsDisplay;
          var directionsService = new google.maps.DirectionsService();

          function loadMapItem(itemID, itemLatitude, itemLongitude, itemIcon){
                
              //create empty LatLngBounds object
              var bounds = new google.maps.LatLngBounds();

              directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
              
              //objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
              //de définir des options d'affichage de notre carte
               
              var myPosition = new google.maps.LatLng($('#uLatitude').html(), $('#uLongitude').html());
              console.log("--- myPosition: "+myPosition);  

              var itemPosition = new google.maps.LatLng(itemLatitude, itemLongitude);
              console.log("--- itemPosition: "+itemPosition);


              calcRoute(myPosition, itemPosition);

             /* MAP DE LA PAGE BOOKMARKS*/
              var mapItemOptions = {
                 // 20 choix possibles:
                // ===================
                // 0 (monde) à 20 (street)
                zoom: 15,
                disableDoubleClickZoom: true,
                scrollwheel: false,
                draggable: false,
                zoomControl: false,
                keyboardShortcuts: false,
                panControl: false,
                mapTypeControl: false,
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.<?php echo $_SESSION['maptype']; ?>
              };
            
              // On construit la carte
              mapItem = new google.maps.Map(document.getElementById('itemMap'), mapItemOptions);
              directionsDisplay.setMap(mapItem);        
              directionsDisplay.setPanel(document.getElementById("directionsPanel"));
            
              google.maps.event.addListener(mapItem, 'idle', function() {
                
                // On affiche le marker sur la carte
                var myItemMarker = new google.maps.Marker({
                                            position: itemPosition,
                                            map: mapItem,
                                            title: 'Position item: ' + itemPosition,
                                            icon: 'images/maps/'+itemIcon
                                        });
                //extend the bounds to include each marker's position
                bounds.extend(myItemMarker.position);

                // On affiche le marker sur la carte
                var myPositionMarker = new google.maps.Marker({
                                            position: myPosition,
                                            map: mapItem,
                                            icon: 'images/maps/me.png'
                                        });
                //extend the bounds to include each marker's position
                bounds.extend(myPositionMarker.position);

                        
                // To add the marker to the map, call setMap();
                //mapItem.panTo(itemPosition);
                //myItemMarker.setMap(mapItem);
                

                //now fit the map to the newly inclusive bounds
                mapItem.fitBounds(bounds);
              })
            }

            function calcRoute(start, end) {
              console.log("--- Calcul de la route:");
              console.log("------ début" + start);
              console.log("------ fin :" + end);
              //var start = document.getElementById("start").value;
              //var end = document.getElementById("end").value;
              var request = {
                origin:start,
                destination:end,
                travelMode: google.maps.TravelMode.DRIVING
              };
              directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                  directionsDisplay.setDirections(result);
                }
              });
            }
            </script>
            <!-- FIN GOOGLE MAP -->		
            <?php
        }
        ?>

         <!-- page : HELP -->
            <div data-role="page" id="helpForm">
                <?php include_once("pages/show/help.php"); ?>
            </div>
        <!-- /page : HELP -->
  <!-- Stockage des informations -->
        <div id="myPopup" data-role="popup" data-dismissible="false"  data-theme="none" data-shadow="false"></div>
     
    </body>
</html>