{include file="main.header.tpl" bodyclass="full"}

<div class="container-fluid pt-0 pb-5 px-0 m-0">
	{if $page != "imperium"}
		{include file="main.topnav.tpl"}
	{/if}
		<div class="d-flex m-0 p-0 justify-content-center">
			{if $page != "imperium"}
				<div class="d-flex justify-content-center contentLeft">
					{include file="main.navigation.tpl"}
				</div>
				{/if}
					<div class="d-flex justify-content-center {if $page!='imperium'}contentMiddle{else}w-100{/if}">
						<content class="content-wrapper">
							{if $hasAdminAccess}
							<div class="alert alert-danger my-2 p-2 fs-12 globalWarning">
							{$LNG.admin_access_1} <a class="fw-bold hover-underline hover-pointer text-danger" id="drop-admin">{$LNG.admin_access_link}</a>{$LNG.admin_access_2}
							</div>
							{/if}
							{if $closed}
							<div class="infobox">{$LNG.ov_closed}</div>
							{elseif $delete}
							<div class="infobox">{$delete}</div>
							{elseif $vacation}
							<div class="infobox">{$LNG.tn_vacation_mode} {$vacation}</div>
							{/if}
							{if $page != "imperium"}
							{include file="fleetTable.tpl"}
							{/if}
							{block name="content"}{/block}
							<table class="hack"></table>
						</content>
					</div>
					{if $page != "imperium"}
					<div class="d-flex flex-column contentRight">
						{include file="main.planetmenu.tpl"}
					</div>
					{/if}
		</div>












	<footer>
		{foreach $cronjobs as $cronjob}<img src="cronjob.php?cronjobID={$cronjob}" alt="">{/foreach}

		<div style="z-index:9999;" class="bg-black d-none d-sm-flex justify-content-center w-100 position-fixed bottom-0 py-1">
			{if isModuleAvailable($smarty.const.MODULE_SERVER_INFO)}
			<span class="font-size-12 px-2 border-end hover-underline text-white hover-pointer" data-bs-toggle="tooltip"
			data-bs-placement="left"
			data-bs-html="true"
			title="
			<table class='table-tooltip bg-black'>
				<thead>
					<tr>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class='text-start color-red fw-bold'>{$LNG.si_game_speed}:</td>
						<td>{$game_speed}</td>
					</tr>
					<tr>
						<td class='text-start color-red'>{$LNG.si_fleet_speed}:</td>
						<td>{$fleet_speed}</td>
					</tr>
					<tr>
						<td class='text-start color-red'>{$LNG.si_production_speed}:</td>
						<td>{$production_speed}</td>
					</tr>
					<tr>
						<td class='text-start color-red'>{$LNG.si_storage_multiplier}:</td>
						<td>{$storage_multiplier}</td>
					</tr>
				</tbody>
			</table>
			">{$LNG.si_universe_info}</span>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_BANLIST)}
			<a class="color-red font-size-12 px-2 border-end hover-underline" href="game.php?page=banList">{$LNG.lm_banned}</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_RECORDS)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="game.php?page=records">{$LNG.lm_records}</a>
			{/if}
	    {if isModuleAvailable($smarty.const.MODULE_BATTLEHALL)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="game.php?page=battleHall">{$LNG.lm_topkb}</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_SIMULATOR)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="game.php?page=battleSimulator">{$LNG.lm_battlesim}</a>
			{/if}

			<a class="font-size-12 px-2 border-end text-white hover-underline" href="index.php?page=rules" target="rules">{$LNG.lm_rules}</a>

			{if isModuleAvailable($smarty.const.MODULE_FORUM)}{if !empty($hasBoard)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="game.php?page=board" target="forum">{$LNG.lm_forums}</a>
			{/if}{/if}
			{if isModuleAvailable($smarty.const.MODULE_DISCORD)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="{$discordUrl}" target="copy">Discord</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_CHAT)}
			<a class="font-size-12 px-2 border-end text-white hover-underline" href="game.php?page=chat">{$LNG.lm_chat}</a>
			{/if}



			
		</div>

		{include file="main.footer.tpl" nocache}
	</footer>

</div>

</body>
</html>
