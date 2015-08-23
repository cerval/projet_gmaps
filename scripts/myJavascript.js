console.log("Langue du navigateur: " + window.navigator.language);

function preloadImage(url)
{
    var img=new Image();
    img.src=url;
    console.log("Préchargement d'image: " + url);
}

preloadImage("images/icons/error.png");
preloadImage("images/icons/success.png");
preloadImage("images/icons/info.png");
preloadImage("images/icons/plus.png");
preloadImage("images/icons/validation.png");
preloadImage("images/delete.png");

/* RESIZING DIV FOR DISPLAY - DEB */
/*
function checkAndResizeContentDiv(){
	var screen = $.mobile.getScreenHeight(),
	header = $(".ui-header").hasClass("ui-header-fixed") ? $(".ui-header").outerHeight() - 1 : $(".ui-header").outerHeight(),
	footer = $(".ui-footer").hasClass("ui-footer-fixed") ? $(".ui-footer").outerHeight() - 1 : $(".ui-footer").outerHeight(),
	contentCurrent = $(".ui-content").outerHeight() - $(".ui-content").height(),
	content = screen - header - footer - contentCurrent;
	$(".ui-content").height(content);
	//alert("content: " + content);
}
$(document).on("pagecontainertransition", function () {
	checkAndResizeContentDiv();
});
$(document).on('pageshow', '[data-role=page]', function () { 
	checkAndResizeContentDiv(); 
});
$(window).on("resize", function () {
	checkAndResizeContentDiv();
});
$(window).on("orientationchange", function () {
	checkAndResizeContentDiv();
});
*/
/* RESIZING DIV FOR DISPLAY - DEB */
function contentHeight() {
    var activePage = $.mobile.pageContainer.pagecontainer("getActivePage"),
        screen = $.mobile.getScreenHeight(),
        header = $(".ui-header", activePage).hasClass("ui-header-fixed") ? $(".ui-header", activePage).outerHeight() - 1 : $(".ui-header", activePage).outerHeight(),
        footer = $(".ui-footer", activePage).hasClass("ui-footer-fixed") ? $(".ui-footer", activePage).outerHeight() - 1 : $(".ui-footer", activePage).outerHeight(),
        contentCurrent = $(".ui-content", activePage).outerHeight() - $(".ui-content", activePage).height(),
        content = screen - header - footer - contentCurrent;
    /* apply result */
    $(".ui-content", activePage).height(content);
	//alert(content);
}

$(document).on("pagecontainertransition", contentHeight);
$(window).on("throttledresize orientationchange resize", contentHeight);
/* RESIZING DIV FOR DISPLAY - FIN */

/* LOGIN FORM - DEB */
$(document).ready(function() {
  // $(window).resize() est appelée chaque fois que la fenêtre est redimensionnée par l'utilisateur.
  $(window).resize(function() {
  
  //console.log("ecran largeur: "+ $(window).width());
  //console.log("div largeur: "+ $("#connexionForm").outerWidth());
  
    $(".connexionForm").css({
      position:'absolute',
      left:($(window).width() - $(".connexionForm").outerWidth()) / 2,
      top:($(window).height() - $(".connexionForm").outerHeight()) / 2
    });
  });
});
 
$(window).load(function() {
  // au chargement complet de la page, la fonction resize() est appelée une fois pour initialiser le centrage.
  $(window).resize(); 
});
/* LOGIN FORM - FIN */


/*
$(document).ready(function() {
      checkAndResizeContentDiv();
});
$(document).load(function() {
      checkAndResizeContentDiv();
});
*/
$(function() {
	$( "body>[data-role='panel']" ).panel().enhanceWithin();
});
/* RESIZING DIV FOR DISPLAY - FIN */

function updatePageContent(myPage,myView){
	
	var url 	= "pages/show/" + myPage + ".php";
	var value 	= "p=" + myView; 
	$.ajax({
            type : 'POST',
            async: false,
            url : url,
            data : value,
            success : function(feedback) {
                $("#updatepage").html(feedback);
            }
	});
	//$('#updatepage').text(value);
	return false;
}
function jsFillNewItemPage(num){

    // On vide les informations présente en cas de changement d'item
    /* 
     $("#dialogHeader").html("");
     $("#dialogIcon").html("");
     $("#dialogType").val("");
     */

	var url 	= "pages/actions/_json.php";
	var value 	= "act=selCategories";
        value   += "&cat=" + num; 
	$.ajax({
      type : 'POST',
      async: false,
      url : url,
      data : value,
      success : function(feedback) {
      
        newItem = jQuery.parseJSON(feedback);
        console.log(newItem);
        
        var tid   	= newItem[0].id;
        var name  	= newItem[0].name;
        var color 	= newItem[0].color;
        var icon  	= newItem[0].icon;
        
        $("#dialogHeader").html(name);
        $("#dialogIcon").html("<img src='images/maps/" + icon + "'/>");
        $("#dialogType").val(tid);
        
        //$("#myDialog").html(feedback);
        //$("#dialogLatitude").val($("#uLatitude").val());
        //$("#dialogLongitude").val($("#uLongitude").val());
        $("#dialogLatitude").val($("#uLatitude").html());
        $("#dialogLongitude").val($("#uLongitude").html());
        $("#dialogLatitude").attr('disabled','disabled');
        $("#dialogLongitude").attr('disabled','disabled');
        console.log("Position: " + $("#dialogLatitude").val() + ", " + $("#dialogLongitude").val());
        /*
        $('#myDialog').popup();
        $('#myDialog').popup('open');
        $('#myDialog').enhanceWithin();
        */
      }
	 });
}
function jsLoadItems(limit, type){
  var url 	= "pages/actions/_post.php";
	var value 	= "act=loadItems";
      value   += "&page=" + limit; 
      value   += "&type=" + type; // 0 = ALL - 1 = BOOKMARKS

  if(type==0){
    var item_to_show = "itemsAllContent_";
    console.log("Chargement des notes ("+limit+")");
  }else{
    var item_to_show = "itemsMyContent_";
    console.log("Chargement des favoris ("+limit+")");
  }

	$.ajax({
      type : 'POST',
      async: false,
      url : url,
      data : value,
      success : function(feedback) {
      
        $("#"+item_to_show+limit).html(feedback).trigger('create');            
      }
	});
}


function jsAddItem(){

$("#createReferenceForm").submit( function() {	// à la soumission du formulaire	
      console.log("Insertion d'une nouvelle référence dans la base de données");
  
      var num         = $("#dialogType").val();
      var myTitle     = $('#dialogTitle').val();
      var myComment 	= $('#dialogComment').val();
      var myLatitude	= $("#dialogLatitude").val();
      var myLongitude	= $("#dialogLongitude").val();

      var url    = "pages/actions/_post.php";
      var value  = "act=addItem";
          value += "&cat=" + num;
          value += "&lat=" + myLatitude;
          value += "&lng=" + myLongitude;
          value += "&ttl=" + myTitle;
          value += "&com=" + myComment;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("Enregistrement OK","success",1);
              showMyPopup(feedback,1);
              location.reload();
          }
      });    
                 return false; // permet de rester sur la même page à la soumission du formulaire
        });
}


function jsItemShow(idItem, itemLatitude, itemLongitude, itemIcon){
  //$("#showBookmark").html("Voici le bookmark de l'item " + itemID);
  console.log("*********************************************");
  console.log("*   Chargement des informations de l'item   *");
  console.log("*********************************************");
  console.log("+ Inscription des informations de l'item dans la case masquée :"+idItem);
  // Ajout pour suppression de l'erreur au rafraichissement de la page
  if(idItem!=0){
    $("#idItemPost").val(idItem);
    console.log("--- id de l'item : "+ idItem);
    $("#itemLatitudePost").val(itemLatitude);
    console.log("--- latitude de l'item : "+ itemLatitude);
    $("#itemLongitudePost").val(itemLongitude); 
    console.log("--- longitude de l'item : "+ itemLongitude);
    $("#itemIconPost").val(itemIcon); 
    console.log("--- icon de l'item : "+ itemIcon);
  }
  jsItemShowRefresh();
}
function jsItemShowRefresh(){
    idItem        = $("#idItemPost").val();
    itemLatitude  = $("#itemLatitudePost").val();
    itemLongitude = $("#itemLongitudePost").val();
    itemIcon      = $("#itemIconPost").val();

    //alert("id:"+idItem+"\r\nlatitude:"+itemLatitude+"\r\nlongitude:"+itemLongitude+"\r\nicon:"+itemIcon);

    var url    = "pages/actions/_post.php";
      var value  = "act=loadDetails";
          value += "&item=" + idItem;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
            //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
            
            $("#itemDetails").html(feedback);
            
            console.log("+ Lancement de la génération de la map");
            loadMapItem(idItem, itemLatitude, itemLongitude, itemIcon);
            
            console.log("+ Lancement de la génération de la note moyenne");
            jsLoadItemAverageNote(idItem);

            console.log("+ Lancement de la récupération de ma note pour cet item");
            jsLoadMyNote(idItem);
            
            //console.log("+ Lancement de la récupération de ma note et de la note moyenne");
            //jsLoadNote(idItem);
            //console.log("+ Chargement de mon commentaire pour cet item");
            //jsLoadMyComment(idItem)

            console.log("+ Chargement des commentaires pour cet item");
            jsLoadAllComments(idItem, 0);
            jsLoadAllComments(idItem, 1);

            //console.log("+ Lancement de la visualisation des commentaires");
            //jsLoadItemComments(idItem);
            
            // On refresh la map après affichage
            google.maps.event.addListener(mapItem, 'idle', function() {
              google.maps.event.trigger(mapItem, 'resize');
            });
          }
      });
      console.log("*********************************************");
}
function jsLoadItemAverageNote(idItem){
  console.log("--- Calcul de la note de l'item: "+idItem);
      var url    = "pages/actions/_post.php";
      var value  = "act=loadAverageNote";
          value += "&item=" + idItem;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              $("#itemAverageNote").html(feedback);
          }
      });
}


function jsLoadMyNote(idItem){
  console.log("--- Récupération de ma note sur l'item: "+idItem);
      var url    = "pages/actions/_post.php";
      var value  = "act=loadMyNote";
          value += "&item=" + idItem;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              $("#itemMyNote").html(feedback).trigger('create'); 
              //showMyPopup(feedback,1);
          }
      });
}

function jsLoadAllComments(idItem, idType){
  // idType = 0 > myComment
  // idType = 1 > allComment
    if(idType==0){
      console.log("--- Chargement de mon commentaire - item: "+idItem);
    }

    if(idType==1){
      console.log("--- Chargement de tous les commentaires - item: "+idItem);
    }

      var url    = "pages/actions/_post.php";
      var value  = "act=loadAllComments";
          value += "&item=" + idItem;
          value += "&type=" + idType;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              if(idType==0){
               $("#itemMyComment").html(feedback).trigger('create');
              }
              if(idType==1){
               $("#itemAllComments").html(feedback).trigger('create');
              }
              //showMyPopup(feedback,1);
          }
      });
}


function jsAddMyComment(){
  
  var idItem  = $("#idItemPost").val();
  var text    = $("#txtMyComment").val();

  console.log("Ajout de myComment à l'item : "+idItem);
  var url    = "pages/actions/_post.php";
  var value  = "act=addMyComment";
      value += "&item=" + idItem;
      value += "&text=" + text;
  $.ajax({
    type : 'POST',
    async: false,
    url : url,
    data : value,
    success : function(feedback) {
      //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
      //$("#itemMyComment").html(feedback);
      showMyPopup(feedback,1);
      jsLoadAllComments(idItem, 0);
      $('#addContent').popup('close');
    }
  });
}
function jsAddMyNote(note){
  
  var idItem  = $("#idItemPost").val();
  //var note    = $("#txtMyComment").val();

  console.log("Ajout de myNote à l'item : "+idItem);
      var url    = "pages/actions/_post.php";
      var value  = "act=addMyNote";
          value += "&item=" + idItem;
          value += "&note=" + note;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              //$("#itemMyNote").html(feedback);
              showMyPopup(feedback,1);
              jsLoadAllComments(idItem, 0);
              $('#addContent').popup('close');
          }
      });
}

function jsLoadNote(idItem){
  console.log("--- Récupération des notes sur l'item: "+idItem);
      var url    = "pages/actions/_post.php";
      var value  = "act=loadNote";
          value += "&item=" + idItem;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              $("#itemDetailNote").html(feedback);
          }
      });
}

function jsUpdateBadge(idComment, type){
  console.log("--- Demande d'ajout d'un "+type+" au commentaire : "+idComment);
    var url    = "pages/actions/_post.php";
    var value  = "act=updateBadge";
        value += "&comment=" + idComment;
        value += "&type=" + type;
    $.ajax({
        type : 'POST',
        async: false,
        url : url,
        data : value,
        success : function(feedback) {
            //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
            //$("#itemAverageNote").html(feedback);
            $("#badge_"+type+"_item_"+idComment).html(feedback);
        }
    });
}
/*
function jsLoadItemComments(idItem){
  console.log("--- Chargement des commentaires de l'item: "+idItem);
        var url    = "pages/actions/_post.php";
      var value  = "act=loadComments";
          value += "&item=" + idItem;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              $("#itemComments").html(feedback);
          }
      });
}*/

function jsAddToBookmark(itemID){
  var url    = "pages/actions/_post.php";
      var value  = "act=addBookmark";
          value += "&item=" + itemID;
      $.ajax({
          type : 'POST',
          async: false,
          url : url,
          data : value,
          success : function(feedback) {
              //showMyPopup("Enregistrement OK","success",1);
              /*
              if(strcmp(feedback,0)==0){
                showMyPopup("<div class='success'>Enregistrement OK</div>",1);
              }else{
                showMyPopup("<div class='warning'>Déjà présent</div>",1);
              }
              */
              showMyPopup(feedback,1);
              //location.reload();
            }
          
      });
}

function jsRemoveToBookmark(){

}

function jsItemShowHide(type){
  // TYPE :
  // 0 = TOUS
  // 1 = ONLY BOOKMARKS
  if(type==0){
    $("#itemsAllContent_0").show();
    $("#itemsMyContent_0").hide();
  }
  if(type==1){
    $("#itemsAllContent_0").hide();
    $("#itemsMyContent_0").show();
  }
  
}

function jsUpdateCategories(){

$("#createCategoriesForm").submit( function() {	// à la soumission du formulaire	
      console.log("Insertion des options dans la base de données");

			var total       	= $('#total_chkbox').val();
			var options	= "";
			var traffic =0;
			var maptype = $('#sel_maptype').val() ;
			//alert(total);
			for(i=1;i<total;i++){
				if($('#chk_cat_'+i).is(':checked')){
					//alert($('#inp_ref_'+i).val());
				options += $('#inp_cat_'+i).val() + ",";
				}
			}
			options = options.substr(0,options.length-1) 
			 //alert(options);
			if($('#chk_traffic').is(':checked')){
				traffic=1;
			}
			 
			  var url    = "pages/actions/_post.php";
			  var value  = "act=updateCategories";
					  value += "&cat=" + options;
					  value += "&trf=" + traffic;
					  value += "&map=" +maptype ;
			  $.ajax({
				  type : 'POST',
				  async: false,
				  url : url,
				  data : value,
				  success : function(feedback) {
					  //showMyPopup("Enregistrement OK","success",1);
					  showMyPopup(feedback,1);
					  location.reload();
				  }
			 });    
             return false; // permet de rester sur la même page à la soumission du formulaire
		});
	
}

function popupFadeOut(){
	$("#myPopup").delay(3000); // Une pause de 3 secondes avant de commencer le fadeOut
	$("#myPopup").fadeTo(2000, 0, function() { // fadeOut d'une durée de 2 secondes
		$('#myPopup').popup('close');// On ferme la popup pour récupérer la main
	});
}

//function showMyPopup(text, CSSclass, fadeBoolean){
function showMyPopup(text, fadeBoolean){
	$("#myPopup").html(text);
	$("#myPopup").css("opacity", "100");
  //$("#myPopup").css("padding", "10px 10px 10px 10px");
    //$("#myPopup").addClass(CSSclass);
	$('#myPopup').popup();
	$('#myPopup').popup('open');

	$('#myPopup').enhanceWithin();
	if(fadeBoolean>0){
		popupFadeOut();
	}

}

function jsLoginForm(userMOD){
    
    if(userMOD==0){
        
        $("#connexionInvite").submit( function() {	// à la soumission du formulaire						 
            console.log("Lancement de la session invité");
            $.ajax({ // fonction permettant de faire de l'ajax
               type: "POST", // methode de transmission des données au fichier php
               url: "pages/actions/_post.php", // url du fichier php
               data: "act=login&log=invite&pwd="+SHA1("invite"), // données à transmettre
               success: function(msg){ // si l'appel a bien fonctionné
                    // 0 - "Variables de sessions définies";
                    // 1 - "Le compte est inactif...";
                    // 2 - "Nom ou mot de passe invalide...";
                    // 3 - "Déconnexion et suppression des sessions";
                    if(msg==0){ // si la connexion en php a fonctionnée
                        console.log("Sessions invité définie");
                        $("span#erreur").html("<div class='success'>Vous &ecirc;tes maintenant connect&eacute; en invité.</div>");
                        // on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
                        location.reload();
                    }
               }
            });
            return false; // permet de rester sur la même page à la soumission du formulaire
        });
        
    }
    
    if(userMOD==1){
    
        $("#connexionUser").submit( function() {	// à la soumission du formulaire						 
            console.log("Lancement de la connexion et génération des sessions");
            $.ajax({ // fonction permettant de faire de l'ajax
               type: "POST", // methode de transmission des données au fichier php
               url: "pages/actions/_post.php", // url du fichier php
               data: "act=login&log="+$("#uLogin").val()+"&pwd="+SHA1($("#uPasswd").val()), // données à transmettre
               success: function(msg){ // si l'appel a bien fonctionné
                    // 0 - "Variables de sessions définies";
                    // 1 - "Le compte est inactif...";
                    // 2 - "Nom ou mot de passe invalide...";
                    // 3 - "Déconnexion et suppression des sessions";
                    if(msg==0){ // si la connexion en php a fonctionnée
                        console.log("Variables de sessions définies");
                        $("span#msgOnLogin").html("<div class='success'>Connexion r&eacute;ussie.</div>");
                        // on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
                        location.reload();
                    }
                    if(msg==1){
                        console.log("Le compte est inactif...");
                        $("span#msgOnLogin").html("<div class='info'>Compte trouvé, mais en état désactivé.</div>");
                    }
                    if(msg==2){// si la connexion en php n'a pas fonctionnée
                        console.log("Nom ou mot de passe invalide...");
                        $("span#msgOnLogin").html("<div class='error'>Erreur lors de la connexion, veuillez v&eacute;rifier votre login et votre mot de passe.</div>");
                        // on affiche un message d'erreur dans le span prévu à cet effet
                    }
               }
            });
            return false; // permet de rester sur la même page à la soumission du formulaire
        });
        
    }
    
}
function jsLogoutForm(){
    console.log("Lancement de la déconnexion et suppression des sessions");
    $("#deconnexionForm").submit( function() {	// à la soumission du formulaire						 
        $.ajax({ // fonction permettant de faire de l'ajax
           type: "POST", // methode de transmission des données au fichier php
           url: "pages/actions/_post.php", // url du fichier php
           data: "act=logout", // données à transmettre
           success: function(msg){ // si l'appel a bien fonctionné
                // 0 - "Variables de sessions supprimées";
                if(msg==0){
                    console.log("Variables de sessions supprimées");
                    $("span#msgOnLogin").html("<div class='success'>Vous &ecirc;tes maintenant déconnect&eacute;.</div>");
                    // on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
                    location.reload();
                }
           }
        });
        return false; // permet de rester sur la même page à la soumission du formulaire
    });
}

function strcmp(s1, s2)   
{  
    if (s1.toString() < s2.toString()) return -1;  
    if (s1.toString() > s2.toString()) return 1;  
      
    return 0;  
}  

function jsCreateUserForm(){
	console.log("Lancement de l'enregistrement d'un utilisateur");
	
	var login = $("#uCreateLogin").val();
	var pwd = SHA1($("#uCreatePasswd").val());
	var pwd2 = SHA1($("#uCreatePasswd2").val());
	var mail = $("#uCreateEmail").val();
	/*
	alert("login length : "+login.length);
	alert("pwd  length : "+pwd.length);
	alert("mail  length : "+mail.length);
	*/
	if(strcmp(pwd, pwd2)==0){
		
		if($("#uCreateLogin").val().length<3){
			console.log("Le nom d'utilisateur doit comporter au moins 3 caractères.");
			$("span#msgOnCreate").html("<div class='warning'>Le nom d'utilisateur doit comporter au moins 3 caractères.</div>");
			return false;
		}
		if($("#uCreatePasswd").val().length<6){
			console.log("Le mot de passe doit comporter au moins 6 caractères.");
			$("span#msgOnCreate").html("<div class='warning'>Le mot de passe doit comporter au moins 6 caractères.</div>");
			return false;
		}
	
		//$("#createUserForm").submit( function() {	// à la soumission du formulaire		
		$.ajax({ // fonction permettant de faire de l'ajax
		   type: "POST", // methode de transmission des données au fichier php
		   url: "pages/actions/_post.php", // url du fichier php
		   data: "act=create&log="+login+"&pwd="+pwd+"&mail="+mail, // données à transmettre
		   success: function(msg){ // si l'appel a bien fonctionné
				// 0 - "Variables de sessions supprimées";
				if(msg==0){
					console.log("Utilisateur créé");
					$("span#msgOnCreate").html("<div class='success'>L'utilisateur a été créé.</div>");
					// on désactive l'affichage du formulaire et on affiche un message de bienvenue à la place
					//location.reload();
          window.location = "index.php";
				}
				if(msg==1){
					console.log("Le nom d'utilisateur et/ou l'adresse email est déjà référencée.");
					$("span#msgOnCreate").html("<div class='error'>Le nom d'utilisateur et/ou l'adresse email est déjà référencée.</div>");
				}
		   }
		});
			//return false; // permet de rester sur la même page à la soumission du formulaire
		//});
	}else{
		console.log("Les mots de passe saisies ne correspondent pas...");
		$("span#msgOnCreate").html("<div class='error'>Les mots de passe ne correspondent pas...</div>");
	}
}