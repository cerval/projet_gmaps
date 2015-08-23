<div class="connexionForm">
	<div class="connexionFormCSS">
		<!-- formulaire de connexion -->
		<form name="connexionUser" id="connexionUser" action="#">
			<table width="100%">
				<tr>
					<td>
						<label for="uLogin"><?php echo constant("_LNG_USERNAME_"); ?>:</label>
						<input type="text" name="uLogin" id="uLogin" value="" data-theme="a" laceholder="<?php echo constant("_LNG_USERNAME_"); ?>" data-mini="true" class="panel" />
					</td>
					<td>
						<label for="uPasswd"><?php echo constant("_LNG_PASSWORD_"); ?>:</label>
						<input type="password" name="uPasswd" id="uPasswd"  data-theme="a" value="" placeholder="<?php echo constant("_LNG_PASSWORD_"); ?>" data-mini="true"  />
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" data-icon="power" data-rel='close' data-role="button" data-theme="c" onclick="javascript:jsLoginForm(1);" value="<?php echo constant("_LNG_CONNECT_"); ?>"></td>
				</tr>
			</table>
		  
		</form>
		<!-- /formulaire de connexion -->
		<!--
		<hr>
			<center>
				<img src="images/sign-in-with-google.png" style="height:57px;" />
				&nbsp;&nbsp;&nbsp;
				<img src="images/facebook-login.png"  style="height:50px;"/>
			</center>
		-->
		<hr>
		<!-- connexion invité -->
		<form name="connexionInvite" id="connexionInvite" action="#">
			<input type="submit" data-rel='close' data-icon="star" data-role="button" data-theme="a" onclick="javascript:jsLoginForm(0);" value="<?php echo constant("_LNG_CONNECT_INVITE_"); ?>">
		</form>
		<!-- /connexion invité -->
		<hr style="margin-top:18px;">

		<a href="#CreateUser" data-role="button" data-theme="d" data-icon="plus"><?php echo constant("_LNG_CREATE_USER_"); ?></a>

		 <center><span id="msgOnLogin"></span></center><!-- span qui contiendra les �ventuels messages d'erreur -->
	</div>
	
	<!-- footer -->
	<div>
		<center>
		<p class="versionning"><?php echo constant("_LNG_VERSION_"); ?> | <a href="#helpForm">Voir l'aide</a></p>  
		</center>
	</div>
</div>
<!-- /footer -->