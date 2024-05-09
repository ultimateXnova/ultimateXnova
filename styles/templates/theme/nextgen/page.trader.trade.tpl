{block name="title" prepend}{$LNG.lm_trader}{/block}
{block name="content"}
<form id="trader" action="" method="post">
	<input type="hidden" name="mode" value="send">
	<input type="hidden" name="resource" value="{$tradeResourceID}">
	<table class="table table-gow table-sm fs-12">
	<tr>
		<th colspan="4">{$LNG.tr_sell} {$LNG.tech.$tradeResourceID}</th>
	</tr>
	<tr>
		<td>{$LNG.tr_resource}</td>
		<td colspan="2">{$LNG.tr_amount}</td>
		<td>{$LNG.tr_quota_exchange}</td>
	</tr>
	<tr>
		<td>{$LNG.tech.$tradeResourceID}</td>
		<td class="text-center">
			<input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" readonly id="ress" value="0"></input>
		</td>
		<td></td>
		<td class="text-center">1</td>
	</tr>
	{foreach $tradeResources as $tradeResource}
	<tr>
		<td>
			<label class="text-center" for="resource{$tradeResource}">{$LNG.tech[$tradeResource]}</label>
		</td>
		<td class="text-center">
			<input name="trade[{$tradeResource}]" id="resource{$tradeResource}" class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary trade_input text-center" type="text" value="0" size="30" data-resource="{$tradeResource}">
		</td>
		<td style="width:100px;" class="text-center align-middle">
			<span id="resource{$tradeResource}Shortly"></span>
		</td>
		<td class="text-center">{$charge[$tradeResource]}</td>
	</tr>
	{/foreach}
	<tr>
		<td class="text-center" colspan="4">
			<input class="btn btn-primary fs-12 py-0 text-white fw-bold" type="submit" value="{$LNG.tr_exchange}">
		</td>
	</tr>
	</table>
</form>

{block name="script" append}
<script type="text/javascript">
var charge = {$charge|json};
</script>
{/block}

{/block}
