<div data-role="header" data-theme="b">
  <h1 style="text-align:left; margin-left:10px;" class="navTitle"><?php echo constant("_LNG_APP_TITLE_"); ?> > <?php echo constant("_LNG_NOTES_"); ?><p class="showElement"></p></h1>
  <a href="#" class="ui-nodisc-icon ui-btn-right" data-icon="cancel-back" data-iconpos="notext" data-rel="back" title="<?php echo constant("_LNG_CANCEL_"); ?>"><?php echo constant("_LNG_CANCEL_"); ?></a>
  <!-- navbar -->
  <div data-role="navbar">
        <ul>
            <li><a href="#" class="ui-btn-active" onclick="javascript:jsItemShowHide(0);">Tous</a></li>
            <li><a href="#" onclick="javascript:jsItemShowHide(1);">Moi</a></li>
        </ul>
    </div>
  <!-- /navbar -->
</div>

<!-- content -->
<div data-role="content" data-theme="c">
	<div id="itemsAllContent_0" style="display:block;"></div>
  <div id="itemsMyContent_0" style="display:none;"></div>
</div>
<!-- /content -->