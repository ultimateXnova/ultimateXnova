{block name="title" prepend}{$LNG.lm_galaxy}{/block}
{block name="content"}

<script type="text/javascript">
	function closePopovers(){
			$('.popover').not(this).popover('hide');
	}
	function closePopover(){
		$('.popover').removeClass('show');
	}
</script>

	<form action="?page=galaxy" method="post" id="galaxy_form">
	<input type="hidden" id="auto" value="dr">
	<table class="table table-gow table-sm fs-12 my-1">
		<thead>
			<tr class="border-3 border-orange">
				<th class="text-center" colspan="4">{$LNG.gl_galaxy}</th>
				<th class="text-center" colspan="4">{$LNG.gl_solar_system}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center">
					<input class="btn bg-dark m-0 text-yellow text-center fs-12 fw-bold" type="button" name="galaxyLeft" value="&lt;" onclick="galaxy_submit('galaxyLeft')">
				</td>
				<td class="text-center">
					<input class="text-center form-control bg-dark text-white border-0" type="text" name="galaxy" value="{$galaxy}" size="5" maxlength="3" tabindex="1">
				</td>
				<td class="text-center">
					<input class="btn bg-dark text-yellow text-center fs-12 fw-bold" type="button" name="galaxyRight" value="&gt;" onclick="galaxy_submit('galaxyRight')">
				</td>
				<td class="text-center">
					<input class="btn bg-dark text-yellow text-center fs-12 fw-bold" type="button" name="systemLeft" value="&lt;" onclick="galaxy_submit('systemLeft')">
				</td>
				<td class="text-center">
					<input class="text-center form-control bg-dark text-white border-0" type="text" name="system" value="{$system}" size="5" maxlength="3" tabindex="2">
				</td>
				<td class="text-center">
					<input class="btn bg-dark text-yellow text-center fs-12 fw-bold" type="button" name="systemRight" value="&gt;" onclick="galaxy_submit('systemRight')">
				</td>
				<td colspan="1">
					<input class="btn bg-dark text-yellow text-center fs-12 fw-bold w-100" id="galaxySubmit" type="submit" value="{$LNG.gl_show}">
				</td>
			</tr>
		</tbody>
	</table>
	</form>
	{if $action == 'sendMissle'}
    <form action="?page=fleetMissile" method="post">
			<input type="hidden" name="galaxy" value="{$galaxy}">
			<input type="hidden" name="system" value="{$system}">
			<input type="hidden" name="planet" value="{$planet}">
			<input type="hidden" name="type" value="{$type}">
		<table class="table table-gow table-sm fs-12 my-1">
			<tr>
				<th colspan="2">{$LNG.gl_missil_launch} [{$galaxy}:{$system}:{$planet}]</th>
			</tr>
			<tr>
				<td>{$missile_count} <input type="text" name="SendMI" size="2" maxlength="7"></td>
				<td>{$LNG.gl_objective}:
					{html_options name=Target options=$missileSelector}
				</td>
			</tr>
			<tr>
				<th colspan="2" style="text-align:center;"><input type="submit" value="{$LNG.gl_missil_launch_action}"></th>
			</tr>
		</table>
	</form>
    {/if}
	<table class="table table-sm table-gow fs-12">
    <tr>
			<th class="text-center" colspan="8">{$LNG.gl_solar_system} {$galaxy}:{$system}</th>
		</tr>
	<tr>
		<th>{$LNG.gl_pos}</th>
		<th>{$LNG.gl_planet}</th>
		<th>{$LNG.gl_name_activity}</th>
		<th>{$LNG.gl_moon}</th>
		<th>{$LNG.gl_debris}</th>
		<th>{$LNG.gl_player_estate}</th>
		<th>{$LNG.gl_alliance}</th>
		<th>{$LNG.gl_actions}</th>
	</tr>
    {for $planet=1 to $max_planets}
	<tr>
    {if !isset($GalaxyRows[$planet])}
		<td class="text-center align-middle">
			<a href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=7">{$planet}</a>
		</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    {elseif $GalaxyRows[$planet] === false}
		<td class="text-center align-middle">
			{$planet}
		</td>
        <td></td>
        <td style="white-space: nowrap;">{$LNG.gl_planet_destroyed}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    {else}
		<td class="text-center align-middle">
			{$planet}
		</td>
        {$currentPlanet = $GalaxyRows[$planet]}
		<td class="text-center align-middle">
			<a onclick="closePopovers();" class="hover-pointer" data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			title ="
			<table class='table table-gow position-relative fs-11' style='width:220px'>
				<tr>
					<th colspan='2'>
						<span>{$LNG.gl_planet} {$currentPlanet.planet.name} [{$galaxy}:{$system}:{$planet}]</span>
						<button style='height:18px;width:18px;bottom:3px;right:3px;' class='position-absolute p-0 m-0' onclick='closePopover();'>X</button>
					</th>
				</tr>
				{if $userAuthLevel == 3}
				<tr>
					<td>user ID:</td>
					<td>{$currentPlanet['user']['id']}</td>
				</tr>
				<tr>
					<td>planet ID:</td>
					<td>{$currentPlanet['planet']['id']}</td>
				</tr>
				{/if}
				<tr>
					<td style='width:80px'><img src='{$dpath}planeten/{$currentPlanet.planet.image}.jpg' height='75' width='75'></td>
					<td>
						<div class='d-flex flex-column'>
						{if $currentPlanet.missions.6}
						<a class='hover-underline my-1 hover-pointer' onclick='doit(6,{$currentPlanet.planet.id})'>{$LNG.type_mission_6}</a>
						{/if}
						{foreach $currentPlanet.user.class as $class}
						{if $class != 'vacation' && $currentPlanet.planet.phalanx}
						<a class='hover-underline my-1 hover-pointer' onclick='OpenPopup(&quot;?page=phalanx&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&quot;, &quot;&quot;, 640, 510);'>
							{$LNG.gl_phalanx}
						</a>
						{/if}
						{foreachelse}
						{if $currentPlanet.planet.phalanx}
						<a class='hover-underline my-1 hover-pointer' onclick='OpenPopup(&quot;?page=phalanx&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&quot;, &quot;&quot;, 640, 510);'>{$LNG.gl_phalanx}</a>
						{/if}
						{/foreach}
						{if $currentPlanet.missions.1}
						<a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=1'>
							{$LNG.type_mission_1}
						</a>
						{/if}
						{if $currentPlanet.missions.5}
						<a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=5'>
							{$LNG.type_mission_5}
						</a>
						{/if}
						{if $currentPlanet.missions.4}
						<a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=4'>
							{$LNG.type_mission_4}
						</a>
						{/if}
						{if $currentPlanet.missions.3}
						<a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=3'>
							{$LNG.type_mission_3}
						</a>
						{/if}
						<a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1&amp;target_mission=17'>
							{$LNG.type_mission_17}
						</a>
						{if $currentPlanet.missions.10}
						<a class='hover-underline my-1 hover-pointer' href='?page=galaxy&amp;action=sendMissle&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}'>{$LNG["type_mission_10"]}</a>
						{/if}
					</div>
					</td>
				</tr>
			</table>">
				<img class="hover-border-yellow" src="{$dpath}planeten/{$currentPlanet.planet.image}.jpg" height="30" width="30" alt="">
			</a>
		</td>
		<td class="text-center align-middle" style="white-space: nowrap;">{$currentPlanet.planet.name} {$currentPlanet.lastActivity}</td>
		<td class="text-center align-middle" style="white-space: nowrap;">
			{if $currentPlanet.moon}
			<a onclick="closePopovers();" class="hover-pointer" data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			 title="<table class='table table-gow table-sm fs-11' style='width:240px'>
				 <tr>
					 <th colspan='2'>{$LNG.gl_moon} {$currentPlanet.moon.name} [{$galaxy}:{$system}:{$planet}]</th>
					 <button style='height:18px;width:18px;bottom:3px;right:3px;' class='position-absolute p-0 m-0 text-white fs-11' onclick='closePopover();'>X</button>
				 </tr>
				 {if $userAuthLevel == 3}
 				<tr>
 					<td>user ID:</td>
 					<td>{$currentPlanet['user']['id']}</td>
 				</tr>
 				<tr>
 					<td>planet ID:</td>
 					<td>{$currentPlanet['moon']['id']}</td>
 				</tr>
 				{/if}
				 <tr>
					 <td style='width:80px'>
						 <img src='{$dpath}planeten/mond.jpg' height='75' width='75'>
					 </td>
					 <td>
						 <table class='table table-gow table-sm fs-11' style='width:100%'>
							 <tr>
								 <th colspan='2'>{$LNG.gl_features}</th>
							 </tr>
							 <tr>
								 <td>{$LNG.gl_diameter}</td>
								 <td>{$currentPlanet.moon.diameter|number}</td>
							 </tr>
							 <tr>
								 <td>{$LNG.gl_temperature}</td>
								 <td>{$currentPlanet.moon.temp_min}</td>
							 </tr>
							 <tr>
								 <th colspan='2'>{$LNG.gl_actions}</th>
							 </tr>
							 <tr>
								 <td colspan='2'>
									 <div class='d-flex flex-column'>
									 {if $currentPlanet.missions.1}
									 <a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&galaxy={$galaxy}&system={$system}&planet={$planet}&planettype=3&target_mission=1'>
										 {$LNG.type_mission_1}
									 </a>
									 {/if}
									 {if $currentPlanet.missions.3}
									 <a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&galaxy={$galaxy}&system={$system}&planet={$planet}&planettype=3&target_mission=3'>
										 {$LNG.type_mission_3}
									 </a>
									 {/if}
									 {if $currentPlanet.missions.3}
									 <a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&galaxy={$galaxy}&system={$system}&planet={$planet}&planettype=3&target_mission=4'>
										 {$LNG.type_mission_4}
									 </a>
									 {/if}
									 {if $currentPlanet.missions.5}
									 <a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&galaxy={$galaxy}&system={$system}&planet={$planet}&planettype=3&target_mission=5'>
										 {$LNG.type_mission_5}
									 </a>
									 {/if}
									 {if $currentPlanet.missions.6}
									 <a class='hover-underline my-1 hover-pointer' onclick='doit(6,{$currentPlanet.moon.id});'>
										 {$LNG.type_mission_6}
									 </a>
									 {/if}
									 {if $currentPlanet.missions.9}
									 <a class='hover-underline my-1 hover-pointer' href='?page=fleetTable&galaxy={$galaxy}&system={$system}&planet={$planet}&planettype=3&target_mission=9'>
										 {$LNG.type_mission_9}
									 </a>
										{/if}
									 {if $currentPlanet.missions.10}
									 <a class='hover-underline my-1 hover-pointer' href='?page=galaxy&action=sendMissle&galaxy={$galaxy}&system={$system}&planet={$planet}&type=3'>
										 {$LNG.type_mission_10}
									 </a>
									 {/if}
								 </div>
								</td>
							</tr>
						</table>
					</td>
			</table>">
				<img class="hover-border-yellow" src="{$dpath}planeten/mond.jpg" height="22" width="22" alt="{$currentPlanet.moon.name}">
			</a>
			{/if}
		</td>
		<td class="text-center align-middle" style="white-space: nowrap;">
        {if $currentPlanet.debris}
			<a onclick="closePopovers();" class="hover-pointer" data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			 title="<table class='table table-gow fs-11' style='width:240px'>
				 <tr>
					 <th colspan='2'>{$LNG.gl_debris_field} [{$galaxy}:{$system}:{$planet}]</th>
					 <button style='height:18px;width:18px;bottom:3px;right:3px;' class='position-absolute p-0 m-0 text-white fs-11' onclick='closePopover();'>X</button>
				 </tr>
				 <tr>
					 <td style='width:80px'><img src='{$dpath}planeten/debris.jpg' height='75' style='width:75'></td>
					 <td>
						 <table style='width:100%'>
							 <tr>
								 <th colspan='2'>{$LNG.gl_resources}:</th>
							 </tr>
							 <tr>
								 <td>{$LNG.tech.901}: </td>
								 <td>{$currentPlanet.debris.metal|number}</td>
							 </tr>
							 <tr>
								 <td>{$LNG.tech.902}: </td>
								 <td>{$currentPlanet.debris.crystal|number}</td>
							 </tr>{if $currentPlanet.missions.8 and $recyclers|number > 0}<tr>
								 <th colspan='2'>{$LNG.gl_actions}</th></tr><tr><td colspan='2'>
									 <a class='hover-underline my-1 hover-pointer' onclick='doit(8, {$currentPlanet.planet.id});'>{$LNG["type_mission_8"]}</a>
								 </td>
							 </tr>
							 {/if}
						 </table>
					 </td>
				 </tr>
			 </table>">
			<img class="hover-border-yellow" src="{$dpath}planeten/debris.jpg" height="22" width="22" alt="">
			</a>
        {/if}
		</td>
		<td class="text-center align-middle">
			<a onclick="closePopovers();" class="hover-underline hover-pointer user-select-none" data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			 title="<table class='table table-gow fs-11 w-100'>
				 <tr>
					 <th colspan='2'>{$currentPlanet.user.playerrank}</th>
				 </tr>
				 {if !$currentPlanet.ownPlanet}
				 	{if $currentPlanet.user.isBuddy}
					 <tr class='text-center py-1'>
						 <td>
							 <a class='hover-underline hover-pointer user-select-none' href='#' onclick='return Dialog.Buddy({$currentPlanet.user.id})'>{$LNG.gl_buddy_request}</a>
						 </td>
					 </tr>
					 {/if}
					 <tr class='text-center py-1'>
						 <td>
							 <a class='hover-underline hover-pointer user-select-none' href='#' onclick='return Dialog.Playercard({$currentPlanet.user.id});'>{$LNG.gl_playercard}</a>
						 </td>
					 </tr>
					{/if}
					 <tr class='text-center py-1'>
						 <td>
							 <a class='hover-underline hover-pointer user-select-none' href='?page=statistics&amp;who=1&amp;start={$currentPlanet.user.rank}'>{$LNG.gl_see_on_stats}</a>
						 </td>
					 </tr>
					 <button style='height:18px;width:18px;bottom:3px;right:3px;' class='position-absolute p-0 m-0 text-white fs-11' onclick='closePopover();'>X</button>
				 </table>">
				<span class="{foreach $currentPlanet.user.class as $class}{if !$class@first} {/if}galaxy-username-{$class}{/foreach} galaxy-username">{$currentPlanet.user.username}</span>

				{if !empty($currentPlanet.user.class)}
				<span>(</span>{foreach $currentPlanet.user.class as $class}{if !$class@first}&nbsp;{/if}<span class="galaxy-short-{$class} galaxy-short">{$ShortStatus.$class}</span>{/foreach}<span>)</span>
				{/if}
			</a>
		</td>
		<td class="text-center align-middle" style="white-space: nowrap;">
			{if $currentPlanet.alliance}
			<a onclick="closePopovers();" class="hover-underline hover-pointer user-select-none" data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			 title="<table class='table table-gow fs-11 w-100 px-0'>
				 <tr>
					 <th>{$LNG.gl_alliance} {$currentPlanet.alliance.name} {$currentPlanet.alliance.member}</th>
				 </tr>
				 <tr class='text-center py-1'>
					 <td>
						 <a class='hover-underline hover-pointer' href='?page=alliance&amp;mode=info&amp;id={$currentPlanet.alliance.id}'>{$LNG.gl_alliance_page}</a>
					 </td>
				 </tr>
				 <tr class='text-center py-1'>
					 <td>
						 <a class='hover-underline hover-pointer' href='?page=statistics&amp;start={$currentPlanet.alliance.rank}&amp;who=2'>{$LNG.gl_see_on_stats}</a>
					 </td>
				 </tr>
				 {if $currentPlanet.alliance.web}
				 <tr  class='text-center py-1'>
					 <td>
						 <a class='hover-underline hover-pointer' href='{$currentPlanet.alliance.web}' target='allyweb'>{$LNG.gl_alliance_web_page}</a>
						</td>
					</tr>
					{/if}
				 </table>">
				<span class="{foreach $currentPlanet.alliance.class as $class}{if !$class@first} {/if}galaxy-alliance-{$class}{/foreach} galaxy-alliance">{$currentPlanet.alliance.tag}</span>
			</a>
			{else}-{/if}
		</td>
		<td class="text-center align-middle" style="white-space: nowrap;">
			{if $currentPlanet.action}
				{if $currentPlanet.action.esp}
				<a class='hover-pointer text-decoration-none' data-bs-toggle="tooltip"
				data-bs-placement="top"
				data-bs-html="true"
				title="{$LNG.gl_spy}" class='hover-underline my-1 hover-pointer' onclick="doit(6,{$currentPlanet.planet.id},{$spyShips|json|escape:'html'})">
					<img width="18" height="18" src="{$dpath}img/e.gif" alt="">
				</a>{/if}
				{if $currentPlanet.action.message}
				<a class='hover-pointer text-decoration-none' data-bs-toggle="tooltip"
				data-bs-placement="top"
				data-bs-html="true"
				title="{$LNG.write_message}" onclick="return Dialog.PM({$currentPlanet.user.id})">
					<img width="18" height="18" src="{$dpath}img/m.gif" title="{$LNG.write_message}" alt="">
				</a>{/if}
				{if $currentPlanet.action.buddy}
        <a class='hover-pointer text-decoration-none' data-bs-toggle="tooltip"
				data-bs-placement="top"
				data-bs-html="true"
				title="{$LNG.gl_buddy_request}" onclick="return Dialog.Buddy({$currentPlanet.user.id})">
					<img width="18" height="18" src="{$dpath}img/b.gif" title="{$LNG.gl_buddy_request}" alt="">
				</a>
				{/if}
				{if $currentPlanet.action.missle}
				<a data-bs-toggle="tooltip"
				data-bs-placement="top"
				data-bs-html="true"
				title="{$LNG.gl_missile_attack}" class='hover-pointer text-decoration-none' href="?page=galaxy&amp;action=sendMissle&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;type=1">
					<img width="18" height="18" src="{$dpath}img/r.gif" title="{$LNG.gl_missile_attack}" alt="">
				</a>
				{/if}

			{/if}
			{if $currentPlanet.planet.phalanx}
			<a data-bs-toggle="tooltip"
			data-bs-placement="top"
			data-bs-html="true"
			title="{$LNG.gl_phalanx}" class='hover-pointer text-decoration-none' onclick="OpenPopup('?page=phalanx&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$planet}&amp;planettype=1','',640,510);return false;">
				<img width="18" height="18" src="{$dpath}img/r.gif" title="{$LNG.gl_phalanx}" alt="">
			</a>
			{/if}
		</td>
	{/if}
	</tr>
	{/for}
	<tr>
		<td class="text-center align-middle">{$max_planets + 1}</td>
		<td class="text-center align-middle" colspan="7"><a href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$max_planets + 1}&amp;planettype=1&amp;target_mission=15">{$LNG.gl_out_space}</a></td>
	</tr>
	<tr>
		<td class="text-center align-middle">Trade</td>
		<td class="text-center align-middle" colspan="7"><a href="?page=fleetTable&amp;galaxy={$galaxy}&amp;system={$system}&amp;planet={$max_planets + 2}&amp;planettype=1&amp;target_mission=16">{$LNG.gl_trade_space}</a></td>
	</tr>

	<tr>
		<td class="text-center align-middle" colspan="6">({$planetcount})</td>
		<td colspan="2">
			<a data-bs-toggle="popover"
			data-bs-placement="right"
			data-bs-html="true"
			 title="<table class='table table-gow fs-11' style='width:240px'><tr><th colspan='2'>{$LNG.gl_legend}</td></tr><tr><td style='width:220px'>{$LNG.gl_strong_player}</td><td><span class='galaxy-short-strong'>{$LNG.gl_short_strong}</span></td></tr><tr><td style='width:220px'>{$LNG.gl_week_player}</td><td><span class='galaxy-short-noob'>{$LNG.gl_short_newbie}</span></td></tr><tr><td style='width:220px'>{$LNG.gl_vacation}</td><td><span class='galaxy-short-vacation'>{$LNG.gl_short_vacation}</span></td></tr><tr><td style='width:220px'>{$LNG.gl_banned}</td><td><span class='galaxy-short-banned'>{$LNG.gl_short_ban}</span></td></tr><tr><td style='width:220px'>{$LNG.gl_inactive_seven}</td><td><span class='galaxy-short-inactive'>{$LNG.gl_short_inactive}</span></td></tr><tr><td style='width:220px'>{$LNG.gl_inactive_twentyeight}</td><td><span class='galaxy-short-longinactive'>{$LNG.gl_short_long_inactive}</span></td></tr></table>">{$LNG.gl_legend}</a>
		</td>
	</tr>
	<tr>
		<td colspan="4"><span id="missiles">{$currentmip|number}</span> {$LNG.gl_avaible_missiles}</td>
		<td colspan="4"><span id="slots">{$maxfleetcount}</span>/{$fleetmax} {$LNG.gl_fleets}</td>
	</tr>
	<tr>
		<td colspan="4">
			<span id="elementID210">{$spyprobes|number}</span> {$LNG.gl_avaible_spyprobes}
		</td>
		<td colspan="4">
			<span id="elementID209">{$recyclers|number}</span> {$LNG.gl_avaible_recyclers}
		</td>
	</tr>
	<tr style="display:none;" id="fleetstatusrow">
		<th class="text-center" colspan="8">{$LNG.cff_fleet_target}</th>
	</tr>
	</table>
	<script type="text/javascript">
		status_ok		= '{$LNG.gl_ajax_status_ok}';
		status_fail		= '{$LNG.gl_ajax_status_fail}';
		MaxFleetSetting = {$settings_fleetactions};
	</script>
{/block}
