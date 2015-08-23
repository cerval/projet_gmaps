<!-- footer -->
<?php
if($_SESSION['id']==0){
?>
<div data-role="footer" data-theme="a" data-position="fixed">
<?php
}else{
?>
<div data-role="footer" data-theme="b" data-position="fixed">
<?php	
}
?>

	<!-- navbar -->
	<div data-role="navbar" data-iconpos="right">
		<ul>
			<li><a href="#optionsForm" data-transition="flip" data-icon="gear"><?php echo constant("_LNG_OPTIONS_"); ?></a></li>
			<li><a href="#notesForm" data-transition="flip" data-icon="bullets"><?php echo constant("_LNG_NOTES_"); ?></a></li>
		</ul>
	</div>
	<!-- /navbar -->
</div>
<!-- /footer -->