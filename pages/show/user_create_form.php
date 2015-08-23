<div class="connexionForm">
	<div class="connexionFormCSS">
		<!-- formulaire de connexion -->
		<form name="createUserForm" id="createUserForm" action="#">
			<table width="100%">
				<tr>
					<td>
						<label for="uCreateLogin"><?php echo constant("_LNG_USERNAME_"); ?>&nbsp;<font color="red">*</font>:</label>
					</td>
					<td>
						<input type="text" name="uCreateLogin" id="uCreateLogin" value="" data-theme="a" placeholder="<?php echo constant("_LNG_USERNAME_"); ?>" data-mini="true" class="panel" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="uCreatePasswd"><?php echo constant("_LNG_PASSWORD_"); ?>&nbsp;<font color="red">*</font>:</label>
					</td>
					<td>
						<input type="password" name="uCreatePasswd" id="uCreatePasswd" value="" data-theme="a" placeholder="<?php echo constant("_LNG_PASSWORD_"); ?>" data-mini="true"  />
					</td>
				</tr>
				<tr>
					<td>
						<label for="uCreatePasswd2"><?php echo constant("_LNG_PASSWORD_RETYPE_"); ?>&nbsp;<font color="red">*</font>:</label>
					</td>
					<td>
						<input type="password" name="uCreatePasswd2" id="uCreatePasswd2" value="" data-theme="a" placeholder="<?php echo constant("_LNG_PASSWORD_RETYPE_"); ?>" data-mini="true"  />
					</td>
				</tr>								
				<tr>
					<td>
						<label for="uCreateEmail"><?php echo constant("_LNG_EMAIL_"); ?>&nbsp;<font color="red">*</font>:</label>
					</td>
					<td>
						<input type="email" name="uCreateEmail" id="uCreateEmail" value="" data-theme="a" placeholder="<?php echo constant("_LNG_EMAIL_"); ?>" data-mini="true"  />
					</td>
				</tr>								
				<tr>
					<td colspan="2">
						<!--<input type="submit"  data-role="button" data-theme="b" onclick="javascript:jsCreateUserForm();" value="<?php //echo constant("_LNG_SAVE_"); ?>">-->
						<a href="#" data-role="button"  data-icon="plus" data-theme="c" onclick="javascript:jsCreateUserForm();" ><?php echo constant("_LNG_ADD_"); ?></a>
						<a href="#" data-rel='back' data-icon="back" data-role="button" data-theme="d" ><?php echo constant("_LNG_CANCEL_"); ?></a>
					</td>
				</tr>
			</table>
			  
		</form>
		 <center><span id="msgOnCreate"></span></center><!-- span qui contiendra les éventuels messages d'erreur -->
	</div>


	<!-- footer -->
	<div>
		<center>
		<p class="versionning"><?php echo constant("_LNG_VERSION_"); ?> | <a href="#helpForm" class="versionning">Voir l'aide</a></p>  
		</center>
	</div>
</div>
<!-- /footer -->