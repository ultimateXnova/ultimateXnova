{include file="main.header.tpl" bodyclass="full"}

<div class="wrapper">

	<top>
		<div class="fixed">
		</div>
	</top>

	<logo>
		<div class="fixed">
			<a href="game.php?page=overview"><img src="styles/resource/images/ultimatexnova.svg" width="400px"/></a>
		</div>
	</logo>

	<header>
		<div class="fixed">
			{include file="main.topnav.tpl"}
		</div>
	</header>

	<input style="display:none;" type="checkbox" id="toggle-menu" role="button">
	<menu>
		<div class="fixed">
			{include file="main.navigation.tpl"}
		</div>
	</menu>

	<content>
		{if $hasAdminAccess}
		<div class="globalWarning">
		{$LNG.admin_access_1} <a id="drop-admin">{$LNG.admin_access_link}</a>{$LNG.admin_access_2}
		</div>
		{/if}
		{if $closed}
		<div class="infobox">{$LNG.ov_closed}</div>
		{elseif $delete}
		<div class="infobox">{$delete}</div>
		{elseif $vacation}
		<div class="infobox">{$LNG.tn_vacation_mode} {$vacation}</div>
		{/if}

		{block name="content"}{/block}
		<table class="hack"></table>
	</content>

	<footer>
		{foreach $cronjobs as $cronjob}<img src="cronjob.php?cronjobID={$cronjob}" alt="">{/foreach}

		<div style="z-index:9999;" class="bg-black d-none d-sm-flex justify-content-center w-100 position-fixed bottom-0 py-1">
			{if isModuleAvailable($smarty.const.MODULE_BANLIST)}
			<a class="color-red font-size-12 px-2 border-end" href="game.php?page=banList">{$LNG.lm_banned}</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_RECORDS)}
			<a class="font-size-12 px-2 border-end" href="game.php?page=records">{$LNG.lm_records}</a>
			{/if}
	    {if isModuleAvailable($smarty.const.MODULE_BATTLEHALL)}
			<a class="font-size-12 px-2 border-end" href="game.php?page=battleHall">{$LNG.lm_topkb}</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_SIMULATOR)}
			<a class="font-size-12 px-2 border-end" href="game.php?page=battleSimulator">{$LNG.lm_battlesim}</a>
			{/if}

			<a class="font-size-12 px-2 border-end" href="index.php?page=rules" target="rules">{$LNG.lm_rules}</a>

			<a class="font-size-12 px-2 border-end" href="game.php?page=questions">{$LNG.lm_faq}</a>
			{if isModuleAvailable($smarty.const.MODULE_FORUM)}{if !empty($hasBoard)}
			<a class="font-size-12 px-2 border-end" href="game.php?page=board" target="forum">{$LNG.lm_forums}</a>
			{/if}{/if}
			{if isModuleAvailable($smarty.const.MODULE_DISCORD)}
			<a class="font-size-12 px-2 border-end" href="{$discordUrl}" target="copy">Discord</a>
			{/if}
			{if isModuleAvailable($smarty.const.MODULE_CHAT)}
			<a class="font-size-12 px-2 border-end" href="game.php?page=chat">{$LNG.lm_chat}</a>
			{/if}



			{foreach $cronjobs as $cronjob}
				<img src="cronjob.php?cronjobID={$cronjob}" alt="">
			{/foreach}
		</div>

		{include file="main.footer.tpl" nocache}
	</footer>
</div>

</body>
</html>
