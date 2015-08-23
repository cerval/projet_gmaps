<div data-role="header" data-theme="b">
  <h1 style="text-align:left; margin-left:10px;" class="navTitle"><?php echo constant("_LNG_APP_TITLE_"); ?> > <?php echo constant("_LNG_OPTIONS_"); ?><p class="showElement"></p></h1>
  <a href="#" class="ui-nodisc-icon ui-btn-right" data-icon="cancel-back" data-iconpos="notext" data-rel="back" title="<?php echo constant("_LNG_CANCEL_"); ?>"><?php echo constant("_LNG_CANCEL_"); ?></a>
  <!--<a href="#" class="ui-nodisc-icon" data-icon="delete" data-iconpos="notext" data-rel="back" title="<?php echo constant("_LNG_CANCEL_"); ?>"><?php echo constant("_LNG_CANCEL_"); ?></a>-->
</div>

<!-- content -->
<div data-role="content" data-theme="a">
	<!--<div id="myOptionsContent">-->
	
	
		<form name="createCategoriesForm" id="createCategoriesForm" action="#">
			<?php 
			include_once("config/config.php");
			connect();

			
			echo "<h3>".constant("_LNG_SETUP_")."</h3>";
			
			echo "<div data-role='fieldcontain'>";
				echo "<fieldset data-role='controlgroup'>";
				echo "<legend>".constant("_LNG_SHOW_TRAFFIC_")."</legend>";
				if($_SESSION['traffic']==1){
					echo "<input type='checkbox' name='chk_traffic' id='chk_traffic' class='custom' checked />";
				}else{
					echo "<input type='checkbox' name='chk_traffic' id='chk_traffic' class='custom' />";
				}
				echo "<label for='chk_traffic'>".constant("_LNG_SHOW_TRAFFIC_ON_MAP_")."</label>";  
			echo "<br>";
			echo "</fieldset>";
			echo "</div>";
			
			
				
			echo "<div data-role='fieldcontain'>";
				echo "<fieldset data-role='controlgroup'>";
				echo "<legend>".constant("_LNG_MAPTYPE_")."</legend>";
			// MapTypeId.ROADMAP displays the default road map view. This is the default map type.
			// MapTypeId.SATELLITE displays Google Earth satellite images
			// MapTypeId.HYBRID displays a mixture of normal and satellite views
			// MapTypeId.TERRAIN displays a physical map based on terrain information.
			
			//echo "	<label for='select-choice-1' class='select'>Type de MAP:</label>";
			echo "	<select name='sel_maptype' id='sel_maptype'>";
			if(strcmp($_SESSION['maptype'],"ROADMAP")==0){
			echo "		<option value='ROADMAP' selected>ROADMAP</option>";
			}else{
			echo "		<option value='ROADMAP'>ROADMAP</option>";
			}
			if(strcmp($_SESSION['maptype'],"SATELLITE")==0){
			echo "		<option value='SATELLITE' selected>SATELLITE</option>";
			}else{
			echo "		<option value='SATELLITE'>SATELLITE</option>";
			}
			if(strcmp($_SESSION['maptype'],"HYBRID")==0){
			echo "		<option value='HYBRID' selected>HYBRID</option>";
			}else{
			echo "		<option value='HYBRID'>HYBRID</option>";
			}
			if(strcmp($_SESSION['maptype'],"TERRAIN")==0){
			echo "		<option value='TERRAIN' selected>TERRAIN</option>";
			}else{
			echo "		<option value='TERRAIN'>TERRAIN</option>";
			}
			
			echo "	</select>";
			echo "<br>";
			echo "</fieldset>";
			echo "</div>";
			
			echo "<h3>".constant("_LNG_CATEGORIES_")."</h3>";
			$num=1;
			
			$disabled = '';
			if($_SESSION['id']==0){
				$disabled = ' class="ui-state-disabled" ';
			}

			$arrCategories = explode(",", $_SESSION['categories']);
			
			$sql_parent = "SELECT id, name FROM _categories WHERE parent=0 and enable=1";
			$res_parent = mysql_runsql($sql_parent);
			while($v_parent = mysql_fetch_object($res_parent)){
				
				echo "<div data-role='fieldcontain'>";
				echo "<fieldset data-role='controlgroup'>";
				echo "<legend>".constant($v_parent->name)."</legend>";

				$sql_link = "SELECT id, name, color, icon  FROM _categories WHERE parent=".$v_parent->id." AND enable=1";
				$res_link = mysql_runsql($sql_link);
				while($v_link = mysql_fetch_object($res_link)){        
					
					echo "<input type='hidden' id='inp_cat_".$num."' name='inp_cat_".$num."' value='".$v_link->id."' />";
					if(in_array($v_link->id, $arrCategories)){
						echo "<input type='checkbox' name='chk_cat_".$num."' id='chk_cat_".$num."' class='custom' checked />";
					}else{
						echo "<input type='checkbox' name='chk_cat_".$num."' id='chk_cat_".$num."' class='custom' />";
					}
					echo "<label for='chk_cat_".$num."'>".constant($v_link->name)."<div class='iconListviewPanel'><img src='images/maps/".$v_link->icon."' width='20px;' /></div></label>";  
					$num++;
				}
				echo "<br>";
				echo "</fieldset>";
				echo "</div>";
			}
			echo "<input type='hidden' id='total_chkbox' name='total_chkbox' value='".$num."' />";
			@close();
			?>

			<input type="submit" onclick="javascript:jsUpdateCategories();" data-role="button" data-icon="check" data-rel="close" data-theme="c" value="<?php echo constant("_LNG_SAVE_"); ?>" />
			<!--<a href="#" data-role="button" data-rel="back" data-theme="c"><?php //echo constant("_LNG_CANCEL_"); ?></a>   -->
		</form>
	<!--</div>-->
</div>
<!-- /content -->