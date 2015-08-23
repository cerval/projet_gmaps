<!-- header -->
<?php
if($_SESSION['id']==0){
?>
<div data-role="header" data-theme="a" data-position="fixed">
<?php
}else{
?>
<div data-role="header" data-theme="b" data-position="fixed">
<?php	
}
?>

	<h1><a href="#" onclick="javascript:refreshMyMap();" class="navTitle"><?php echo constant("_LNG_APP_TITLE_"); ?></a></h1>
	<a href="#pnlLeft" data-icon="bars" data-iconpos="notext"><?php echo constant("_LNG_MENU_"); ?></a>
	<a href="#pnlRight" data-icon="user" data-iconpos="notext"><?php echo constant("_LNG_PROFILE_"); ?></a>
</div>
<!-- /header -->