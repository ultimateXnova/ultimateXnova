{block name="title" prepend}{$LNG.lm_trader}{/block}
{block name="content"}
{if $requiredDarkMatter}
<table class="table table-gow fs-12 table-sm">
<tr>
	<th class="text-center">{$LNG.fcm_info}</th>
</tr>
<tr>
	<td><span style="color:red;">{$requiredDarkMatter}</span></td>
</tr>
</table>

{/if}
<table class="table table-gow fs-12 table-sm">
<tr>
	<th class="text-center">{$LNG.tr_call_trader}</th>
</tr>
<tr>
	<td>
		<div class="fs-12 fw-bold text-center color-blue border border-dark">{$LNG.tr_call_trader_who_buys}</div>
		<div id="traderContainer" class="centerContainer">
			<div class="outer">
				<div class="inner d-flex justify-content-center py-2">
					{foreach $charge as $resourceID => $chageData}
						{if !$requiredDarkMatter}
						<form class="px-2" action="game.php?page=trader" method="post">
						<input type="hidden" name="mode" value="trade">
						<input type="hidden" name="resource" value="{$resourceID}">
						<div class="d-flex flex-column justify-content-center align-items-center">
							<label for="trader_metal" class="color-blue fw-bold fs-11">{$LNG.tech.$resourceID}</label>
							<input type="image" id="trader_metal" src="{$dpath}images/{$resource.$resourceID}.gif" title="{$LNG.tech.$resourceID}" border="0" height="32" width="52">
						</div>
						</form>
						{else}
							<img src="{$dpath}images/{$resource.$resourceID}.gif" title="{$LNG.tech.$resourceID}" border="0" height="32" width="52" style="margin: 3px;">
							<span>{$LNG.tech.$resourceID}</span>
						{/if}
					{/foreach}
				</div>
			</div>
			<div class="clear"></div>
		</div>
		</div>
		<div>
			<p class="text-center fs-11 fw-bold color-white">{$tr_cost_dm_trader}</p>
			<p class="text-center fs-11 fw-bold color-white">{$LNG.tr_exchange_quota}: {$charge.901.903}/{$charge.902.903}/{$charge.903.903}</p>
		</div>
	</td>
</tr>
</table>
{/block}
