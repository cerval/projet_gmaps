<!-- rightpanel  -->
<div data-role="panel" id="pnlRight" data-position="right" data-display="overlay" data-theme="a" style="background-color:#e9e9e9;">

    <ul data-role="listview" data-divider-theme="a" style="height:60px;margin-bottom:-21px;">
        <li data-icon="delete"><a href="#" data-rel="close"><?php echo constant("_LNG_CLOSE_"); ?></a></li>
    </ul>
    <ul data-role="listview" data-theme="a">
        <!--<li><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline"><?php echo constant("_LNG_CLOSE_"); ?></a></li>-->
        
        <li data-role="list-divider" style="margin-top:0px;"><?php echo constant("_LNG_INFO_USER_"); ?></li>

        <li class="ui-field-contain" data-icon="user">
            <a href="#" class="nohover"><?php echo constant("_LNG_LOGIN_"); ?>:<span style="float:right;font-weight: normal;"><?php echo $_SESSION['login']; ?></span></a>
        </li>
        <li class="ui-field-contain" data-icon="bullets" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_CATEGORIES_"); ?>:<span style="float:right;font-weight: normal;"><?php echo $_SESSION['categories']; ?></span></a>
        </li>
        <li class="ui-field-contain" data-icon="navigation" style="margin-top:-1px;">
            <?php 
            if ($_SESSION['traffic']==1) {
            ?>
                <a href="#"><?php echo constant("_LNG_TRAFFIC_"); ?>:<span style="float:right;font-weight: bold;color:green;"><?php echo constant("_LNG_ENABLE_"); ?></span></a>
            <?php
            }else{
            ?>
                <a href="#"><?php echo constant("_LNG_TRAFFIC_"); ?>:<span style="float:right;font-weight: bold;color:red;"><?php echo constant("_LNG_DISABLE_"); ?></span></a>
            <?php
            }
            ?>
        </li>
        <li class="ui-field-contain" data-icon="action" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_MAPTYPE_"); ?>:<span style="float:right;font-weight: normal;"><?php echo $_SESSION['maptype']; ?></span></a>
        </li>
        <li class="ui-field-contain" data-icon="check" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_ENABLE_"); ?>:<span style="float:right;font-weight: bold;color:green;"><?php echo constant("_LNG_ENABLE_"); ?></span></a>           
        </li>  
        
        <li data-role="list-divider" style="margin-top:0px;"><?php echo constant("_LNG_INFO_POSITION_"); ?></li>
        <li class="ui-field-contain" data-icon="location" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_LATITUDE_"); ?><div style="float:right;font-weight: normal;"><span id="uLatitude"></span></div></a>
        </li>
        <li class="ui-field-contain" data-icon="location" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_LONGITUDE_"); ?><div style="float:right;font-weight: normal;"><span id="uLongitude"></span></div></a>
        </li>

        <li class="ui-field-contain" data-icon="cloud" style="margin-top:-1px;">
            <a href="#"><?php echo constant("_LNG_IP_ADDRESS_"); ?>:<span style="float:right;font-weight: normal;"><?php echo $_SERVER['REMOTE_ADDR']; ?></span></a>
        </li>

        <li class="ui-field-contain" style="margin-top:-3px;">
            <?php 
            //echo "<pre>";
            //print_r($_SESSION); 
            //echo "</pre>";
            /*
            Array
            (
                [sid] => ma84a3nojjlb7to5f75ndqded4
                [id] => 1
                [login] => pripaux
                [categories] => 2,3,4,5,6,8,9,11
                [traffic] => 0
                [maptype] => ROADMAP
                [enable] => 1
            )
             */
            ?>
            <!-- formulaire de déconnexion -->
            <form name="deconnexionForm" id="deconnexionForm" action="#" style="margin-top:-16px;margin-bottom:-16px;margin-right:-16px;margin-left:-16px;">
            <input type="submit" data-rel='close' data-theme="d" onclick="javascript:jsLogoutForm();" value="<?php echo constant("_LNG_DISCONNECT_"); ?>">
            <!--<span id="erreur"></span>--><!-- span qui contiendra les éventuels messages d'erreur -->
            </form>
            <!-- /formulaire de déconnexion -->
        </li>  

        <li data-role="list-divider" style="margin-top:-1px;"><?php echo constant("_LNG_SETTINGS_"); ?></li>
        <li class="ui-field-contain" data-icon="mail">
            <a href="mailto:pripaux@gmail.com"><?php echo constant("_LNG_CONTACT_US_"); ?></a>
        </li>
        <li class="ui-field-contain" data-icon="info" style="margin-top:-1px;">
            <a href="#helpForm"><?php echo constant("_LNG_HELP_"); ?></a>
        </li>
    </ul>
</div>
<!-- /rightpanel -->