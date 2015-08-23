<div data-role="header" data-theme="b">
  <h1 style="text-align:left; margin-left:10px;" class="navTitle"><?php echo constant("_LNG_APP_TITLE_"); ?> > <?php echo constant("_LNG_ITEMS_"); ?><p class="showElement"></p></h1>
  <a href="#" class="ui-nodisc-icon ui-btn-right" data-icon="cancel-back" data-iconpos="notext" data-rel="back" title="<?php echo constant("_LNG_CANCEL_"); ?>"><?php echo constant("_LNG_CANCEL_"); ?></a>
</div>

<!-- content -->
<div data-role="content" data-theme="a">
	
	<input type="hidden" id="idItemPost" value="0" />
	<input type="hidden" id="itemLatitudePost" value="0" />
	<input type="hidden" id="itemLongitudePost" value="0" />
	<input type="hidden" id="itemIconPost" value="0" />
	
	<div id="itemDetails"></div>
	
	<!--<h2>Note moyenne:</h2>-->
	<br />
	<b>Note moyenne:</b> <div id="itemAverageNote" style="display:inline;"></div>
	<br />
	<!--<div id="jRate_Average"></div>-->
	<!--<div id="itemMap" style="width:600px;height:300px;"></div>-->
	<br>
	
	<div class="spacer"></div>
	<div id="itemMap" style="float:left;width:70%; height:600px;"></div>
	<div id="directionsPanel" style="float:right;width:30%;height:600px;overflow:auto;"></div>
	<div class="spacer"></div>
	
	<br>
	
	<!--<div id="itemAddComments">-->
		<!--<label for="textareaComment">Mon commentaireCommentaire :</label>-->
		<!--<textarea name="textareaComment" id="textareaComment"></textarea>-->
		<!--<a href="#addContent" data-role="button" data-theme="b" data-icon="plus"><?php echo constant("_LNG_ADD_CONTENT_"); ?></a>-->
	<a href="#addContent" data-rel="popup" data-position-to="window" data-role="button" data-theme="b" data-icon="plus" data-inline="true"><?php echo constant("_LNG_ADD_CONTENT_"); ?></a>
	<!--</div>-->
	<hr>
	<!--<div id="itemNotes">Toutes les notes</div>-->
	<div id="itemMyComment">Mon commentaires et ma note</div>
	<div class="spacer"></div>
	<br>
	<div id="itemAllComments">Tous les commentaires et toutes les notes</div>
	<hr>
</div>
<!-- /content -->

<!-- popup -->
<div data-role="popup" id="addContent" data-theme="a" class="ui-corner-all">
	<div style="min-width: 300px; padding: 10px 20px;">
		
		<label for="txtComment">Commentaire:</label>
      	<TEXTAREA name="user" id="txtMyComment" value="" rows="6" ></TEXTAREA>
		<!--<button type="submit" data-theme="b" onclick="javascript:jsAddMyComment();">Valider</button>-->

		Ma note : <p id="jRate_myNote-onchange-value" style="display:inline;"></p>
		<div id="itemMyNote"></div>
		<!--<div id="jRate_myNote"></div>-->
		<div id="itemDetailNote"></div>
		<br>
		La sélection de la note enregistrera le commentaire ET la note.

	</div>
</div>
<!-- /popup -->