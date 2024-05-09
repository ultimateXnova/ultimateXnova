{block name="title" prepend}{$LNG.siteTitleDisclamer}{/block}
{block name="content"}
<h1>{$LNG.siteTitleDisclamer}</h1>
<div class="box-border dark-blur-bg box-shadow-large">
<table id="disclamerTable">
	<tr>
		<td style="width:50%;text-align:left;">{$LNG.disclamerLabelAddress}</td><td style="width:50%;text-align:left;">{$disclamerAddress}</td>
	</tr>
	<tr>
		<td style="width:50%;text-align:left;">{$LNG.disclamerLabelPhone}</td><td style="width:50%;text-align:left;">{$disclamerPhone}</td>
	</tr>
	<tr>
		<td style="width:50%;text-align:left;">{$LNG.disclamerLabelMail}</td><td style="width:50%;text-align:left;"><a href="{$disclamerMail}">{$disclamerMail}</a></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:left;"><p><br></p></td>
	</tr>
	<tr>
		<td colspan="2">{$LNG.disclamerLabelNotice}</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:left;">{$disclamerNotice}</td>
	</tr>
</table>
</div>
{/block}