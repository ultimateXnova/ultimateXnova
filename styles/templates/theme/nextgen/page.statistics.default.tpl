{block name="title" prepend}{$LNG.lm_statistics}{/block}
{block name="content"}
<form name="stats" id="stats" method="post" action="">
	<table class="table table-gow table-sm fs-12">
		<tr>
			<th class="text-center">{$LNG.st_statistics} ({$LNG.st_updated}: {$stat_date})</th>
		</tr>
		<tr>
			<td class="d-flex align-items-center justify-content-around">
				<label for="who">{$LNG.st_show}</label>
				<select  style="width:auto;" class="form-select bg-dark py-0 my-0 fs-12" name="who" id="who" onchange="$('#stats').submit();">
					{html_options options=$Selectors.who selected=$who}
				</select>
				<label for="type">{$LNG.st_per}</label>
				<select  style="width:auto;" class="form-select bg-dark py-0 my-0 fs-12" name="type" id="type" onchange="$('#stats').submit();">
					{html_options options=$Selectors.type selected=$type}
				</select>
				<label for="range">{$LNG.st_in_the_positions}</label>
				<select style="width:auto;" class="form-select bg-dark py-0 my-0 fs-12" name="range" id="range" onchange="$('#stats').submit();">
					{html_options options=$Selectors.range selected=$range}
				</select>
			</td>
		</tr>
	</table>
</form>
<table class="table table-gow table-sm fs-12 my-1">
{if $who == 1}
	{include file="shared.statistics.playerTable.tpl"}
{elseif $who == 2}
	{include file="shared.statistics.allianceTable.tpl"}
{/if}
</table>
{/block}
{block name="script" append}
    <script src="scripts/game/statistics.js"></script>
{/block}
