{block name="title" prepend}{$LNG.lm_options}{/block}
{block name="content"}
<form action="game.php?page=settings" method="post">
<input type="hidden" name="mode" value="send">
	<table class="table table-gow table-sm fs-12">
	<tbody>
		{if $userAuthlevel > 0}
		<tr>
			<th class="text-center" colspan="2">{$LNG.op_admin_title_options}</th>
		</tr>
		<tr>
			<td>{$LNG.op_admin_planets_protection}</td>
			<td class="text-center">
				<input name="adminprotection" type="checkbox" value="1" {if $adminProtection > 0}checked="checked"{/if}>
			</td>
		</tr>
		{/if}
		{if $isMultiUniverse}
		<tr>
			<th class="text-center" colspan="2">{$LNG.multiUniverse}</th>
		</tr>
		<tr>
			<th class="text-center" colspan="2">{$newUniMsg}</th>
		</tr>
		<tr>
			<th class="text-center" colspan="2">{$LNG.multiUniverseDescription}</th>
		</tr>
		<tr>
			<td class="text-center" colspan="2">
			{foreach $availableUniverses as $universeID => $universeName}
				<a href="game.php?page=settings&startinuni={$universeID}" class="uk-button">{$LNG.startInMultiUniverse} {$universeName}</a>
			{/foreach}
			</td>

		</tr>
		{/if}
		
		<tr>
			<th class="text-center" colspan="2">{$LNG.op_user_data}</th>
		</tr>
		<tr>
			<td width="50%">{$LNG.op_username}</td>
	    <td width="50%" style="height:22px;">
				{if $changeNickTime < 0}
				<input class="form-control bg-dark text-white py-0 my-0 text-center" name="username" size="20" value="{$username}" type="text">
				{else}
				{$username}
				{/if}
			</td>
	</tr>
	<tr>
	    <td>{$LNG.op_old_pass}</td>
	    <td>
				<input class="form-control bg-dark text-white py-0 my-0 text-center" name="password" size="20" type="new-password">
			</td>
	</tr>
	<tr>
	    <td>{$LNG.op_new_pass}</td>
	    <td><input class="form-control bg-dark text-white py-0 my-0 text-center" name="newpassword" size="20" maxlength="40" type="new-password"></td>
	</tr>
	<tr>
	    <td>{$LNG.op_repeat_new_pass}</td>
	    <td><input class="form-control bg-dark text-white py-0 my-0 text-center" name="newpassword2" size="20" maxlength="40" type="new-password" class="autocomplete"></td>
	</tr>
	<tr>
	    <td><a title="{$LNG.op_email_adress_descrip}">{$LNG.op_email_adress}</a></td>
	    <td><input class="form-control bg-dark text-white py-0 my-0 text-center" name="email" maxlength="64" size="20" value="{$email}" type="text"></td>
	</tr>
	<tr>
	    <td style="height:22px;">{$LNG.op_permanent_email_adress}</td>
	    <td>{$permaEmail}</td>
		</tr>
		<tr>
			<th class="text-center" colspan="2">{$LNG.op_general_settings}</th>
		</tr>
		<tr>
			<td>{$LNG.op_timezone}</td>
			<td>{html_options class="form-select bg-dark py-0 my-0 text-white" name=timezone options=$Selectors.timezones selected=$timezone}</td>
		</tr>
		{if count($Selectors.lang) > 1}
		<tr>
			<td>{$LNG.op_lang}</td>
			<td>{html_options class="form-select bg-dark text-white py-0 my-0" name=language options=$Selectors.lang selected=$userLang}</td>
		</tr>
		{/if}
		<tr>
			<td>{$LNG.op_sort_planets_by}</td>
			<td>{html_options class="form-select bg-dark text-white py-0 my-0" name=planetSort options=$Selectors.Sort selected=$planetSort}</td>
		</tr>
		<tr>
			<td>{$LNG.op_sort_kind}</td>
			<td>
				{html_options class="form-select bg-dark text-white py-0 my-0" name=planetOrder options=$Selectors.SortUpDown selected=$planetOrder}
			</td>
		</tr>
		{if $let_users_change_theme}
		<tr>
			<td>{$LNG.op_skin_example}</td>
			<td>
				<select class="form-select bg-dark text-white py-0 my-0" name="user_theme">
					<option {if $theme == 'nextgen'}selected{/if} value="nextgen">NextGen</option>
					<option {if $theme == 'nova'}selected{/if} value="nova">Nova</option>
					<option {if $theme == 'gow'}selected{/if} value="gow">Galaxy of Wars</option>
					<option {if $theme == 'EpicBlueXIII'}selected{/if} value="EpicBlueXIII">Epic Blue</option>
					<option {if $theme == 'office'}selected{/if} value="office">Office</option>
				</select>
			</td>
		</tr>
		
		{/if}
	
		<tr>
			<td colspan="2">
			<h3 class="uk-text-center">{$LNG.op_background_image}</h3>	
			<div class="settings_bg_img-container tm-grid-expand uk-grid-column-small uk-grid">
				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="mars">
						<input id="mars" type="radio" name="user_background_image" value="mars" {if $bg_img == 'mars'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/mars.webp" alt="Orange Mars">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="light_green">
						<input id="light_green" type="radio" name="user_background_image" value="light_green" {if $bg_img == 'light_green'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/light_green.webp" alt="Green Canyon">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="intense_blue">
						<input id="intense_blue" type="radio" name="user_background_image" value="intense_blue" {if $bg_img == 'intense_blue'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/intense_blue.webp" alt="Blue Nightsky">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="dark_blue">
						<input id="dark_blue" type="radio" name="user_background_image" value="dark_blue" {if $bg_img == 'dark_blue'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/dark_blue.webp" alt="Dark Horizon">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="mountains">
						<input id="mountains" type="radio" name="user_background_image" value="mountains" {if $bg_img == 'mountains'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/mountains.webp" alt="Foggy Mountains">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="orbit">
						<input id="orbit" type="radio" name="user_background_image" value="orbit" {if $bg_img == 'orbit'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/orbit.webp" alt="Orbit">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="supernova">
						<input id="supernova" type="radio" name="user_background_image" value="supernova" {if $bg_img == 'supernova'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/supernova.webp" alt="Supernova">
					</label>
				</div>

				<div class="settings_bg_img_select uk-width-1-4@m">
					<label for="spaceport">
						<input id="spaceport" type="radio" name="user_background_image" value="spaceport" {if $bg_img == 'spaceport'}checked{/if}>
						<img src="styles/theme/nextgen/img/background/spaceport.webp" alt="Spaceport">
					</label>
				</div>
			</div>
		</tr>
		<tr>
			<td>{$LNG.op_active_build_messages}</td>
			<td class="text-center"><input name="queueMessages" type="checkbox" value="1" {if $queueMessages == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<td>{$LNG.op_active_spy_messages_mode}</td>
			<td class="text-center"><input name="spyMessagesMode" type="checkbox" value="1" {if $spyMessagesMode == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<td>{$LNG.op_block_pm}</td>
			<td class="text-center"><input name="blockPM" type="checkbox" value="1" {if $blockPM == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<th class="text-center" colspan="2">{$LNG.op_galaxy_settings}</th>
		</tr>
		<tr>
			<td><a title="{$LNG.op_spy_probes_number_descrip}">{$LNG.op_spy_probes_number}</a></td>
			<td><input class="form-control bg-dark text-white py-0 my-0 text-center" name="spycount" size="{$spycount|count_characters + 3}" value="{$spycount}" type="int"></td>
		</tr>
		<tr>
			<td>{$LNG.op_max_fleets_messages}</td>
			<td><input class="form-control bg-dark text-white py-0 my-0 text-center" name="fleetactions" maxlength="2" size="{$fleetActions|count_characters + 2}" value="{$fleetActions}" type="int"></td>
		</tr>
		<tr>
			<th class="text-center">{$LNG.op_shortcut}</th>
			<th class="text-center">{$LNG.op_show}</th>
		</tr>
		<tr>
			<td><img src="{$dpath}img/e.gif" alt="">{$LNG.op_spy}</td>
			<td class="text-center"><input name="galaxySpy" type="checkbox" value="1" {if $galaxySpy == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<td><img src="{$dpath}img/m.gif" alt="">{$LNG.op_write_message}</td>
			<td class="text-center"><input name="galaxyMessage" type="checkbox" value="1" {if $galaxyMessage == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<td><img src="{$dpath}img/b.gif" alt="">{$LNG.op_add_to_buddy_list}</td>
			<td class="text-center"><input name="galaxyBuddyList" type="checkbox" value="1" {if $galaxyBuddyList == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<td><img src="{$dpath}img/r.gif" alt="">{$LNG.op_missile_attack}</td>
			<td class="text-center"><input name="galaxyMissle" type="checkbox" value="1" {if $galaxyMissle == 1}checked="checked"{/if}></td>
		</tr>
		<tr>
			<th class="text-center" colspan="2">{$LNG.op_vacation_delete_mode}</th>
		</tr>
		<tr>
			<td><a title="{$LNG.op_activate_vacation_mode_descrip}">{$LNG.op_activate_vacation_mode}</a></td>
			<td class="text-center"><input name="vacation" type="checkbox" value="1"></td>
		</tr>
		<tr>
			<td><a title="{$LNG.op_dlte_account_descrip}">{$LNG.op_dlte_account}</a></td>
			<td class="text-center"><input name="delete" type="checkbox" value="1" {if $delete > 0}checked="checked"{/if}></td>
		</tr>
		{if isModuleAvailable($smarty.const.MODULE_BANNER)}
		<tr>
			<th class="text-center" colspan="3">{$LNG.ov_userbanner}</th>
		</tr>
		<tr>
			<td colspan="3">
				<img src="userpic.php?id={$userid}" alt="" width="590" height="95" id="userpic"><br><br>
				<table>
					<tr>
						<td class="transparent">HTML:</td>
						<td class="transparent">
							<input class="form-control bg-dark text-white py-0 my-0 text-center" type="text" value='<a href="{$SELF_URL}{if $ref_active}index.php?ref={$userid}{/if}"><img src="{$SELF_URL}userpic.php?id={$userid}"></a>' readonly="readonly" style="width:450px;"></td></tr><tr><td class="transparent">BBCode:</td><td class="transparent">
							<input class="form-control bg-dark text-white py-0 my-0 text-center" type="text" value="[url={$SELF_URL}{if $ref_active}index.php?ref={$userid}{/if}][img]{$SELF_URL}userpic.php?id={$userid}[/img][/url]" readonly="readonly" style="width:450px;">
				</td>
			</tr>
			</table>
			</td>
		</tr>
		{/if}
		<tr>
			<td colspan="2">
				<input class="btn btn-primary text-white btn-block w-100 p-0 m-0" value="{$LNG.op_save_changes}" type="submit"></td>
		</tr>
		</tbody>
	</table>
	</form>
{/block}
