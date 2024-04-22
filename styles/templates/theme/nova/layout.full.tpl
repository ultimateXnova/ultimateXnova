{include file="main.header.tpl" bodyclass="full"}

<div class="d-flex flex-column">
	<div class="d-flex col-12">
		<a class="col-3 d-flex justify-content-center" href="game.php?page=overview">
			<img style="height:120px;width:160px;" src="styles/resource/images/meta.png" />
		</a>
		{if $page != "imperium"}
			{include file="main.topnav.tpl"}
		{/if}
	</div>
	<input style="display:none;" type="checkbox" id="toggle-menu" role="button">
	<div class="d-flex col-12">
		<div class="d-flex flex-column align-items-center col-3">
			{include file="main.navigation.tpl"}
		</div>
		<div class="d-flex col-9">
			<content style="max-width:670px;">
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
				{if $page != "imperium"}
				{include file="fleetTable.tpl"}
				{/if}

				{block name="content"}{/block}
				<table class="hack"></table>
			</content>
		</div>

	</div>

	<footer>
		{foreach $cronjobs as $cronjob}<img src="cronjob.php?cronjobID={$cronjob}" alt="">{/foreach}

		{include file="main.footer.tpl" nocache}
	</footer>
</div>

</body>
</html>
