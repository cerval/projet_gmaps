<?php
// Start the session
//session_start();
?>
<!-- leftpanel  -->
<div data-role="panel" id="pnlLeft" data-position="left" data-display="overlay" data-theme="a" style="background-color:#e9e9e9;">

    <ul data-role="listview" data-divider-theme="a" style="height:60px;margin-bottom:-21px;">
        <li data-icon="delete"><a href="#" data-rel="close"><?php echo constant("_LNG_CLOSE_"); ?></a></li>
    </ul>
    <?php 
    include_once("config/config.php");
    connect();

	$disabled = '';
    if($_SESSION['id']==0){
        $disabled = ' class="ui-state-disabled" ';
    }

    $sql_parent = "SELECT id, name FROM _categories WHERE parent=0 and enable=1";
    $res_parent = mysql_runsql($sql_parent);
    while($v_parent = mysql_fetch_object($res_parent)){
        echo "<!-- collapsible -->";
        echo "<div data-role='collapsible' data-theme='a' data-content-theme='a' data-inset='false' data-collapsed='false' style='margin-top:-1px;'>";
        echo "<h2>" . constant($v_parent->name) . "</h2>";
        echo "	<ul data-role='listview'>";

        $sql_link = "SELECT id, name, color, icon  FROM _categories WHERE parent=".$v_parent->id." AND enable=1";
        $res_link = mysql_runsql($sql_link);
        while($v_link = mysql_fetch_object($res_link)){
                echo "	<li style='border-left: 10px solid ".$v_link->color.";' data-icon='false'>";
                echo "		<a href='#categoriesForm' ".$disabled." onclick='javascript:jsFillNewItemPage(".$v_link->id.");' data-rel='close'>" . constant($v_link->name);
                echo "			<div class='iconListviewPanel'><img src='images/maps/".$v_link->icon."' width='25px;' /></div>";
                echo "		</a>";
                echo "	</li>";				}

        echo "	</ul>";
        echo "</div>";
        echo "<!-- /collapsible -->";
    }

    @close();
    ?>
</div>
<!-- /leftpanel -->