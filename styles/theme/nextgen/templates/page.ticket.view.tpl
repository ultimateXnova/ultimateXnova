{block name="title" prepend}{$LNG.ti_read} - {$LNG.lm_support}{/block}
{block name="content"}
<form action="game.php?page=ticket&mode=send" method="post" id="form">
<input type="hidden" name="id" value="{$ticketID}">
<table class="table table-gow">
	{foreach $answerList as $answerID => $answerRow}
	{if $answerRow@first}
	<tr>
		<th colspan="2">
			<span class="color-blue fs-14">{$LNG.ti_read}:{$answerRow.subject}</span>
		</th>
	</tr>
	{/if}
	<tr>
		<td colspan="2">
			<span class="fs-14 color-blue fw-bold">
				{$LNG.ti_msgtime} {$answerRow.time} {$LNG.ti_from} {$answerRow.ownerName}
			</span>
			<br>
			{if $answerRow@first}
			<span class="fs-14 color-blue fw-bold">
				{$LNG.ti_category}: {$categoryList[$answerRow.categoryID]}
			</span>
			<br>
			{/if}
			<hr>
			<p class="fs-14 text-white">
				{$answerRow.message}
			</p>
		</td>
@@ -28,10 +36,10 @@
	</tr>
	<tr>
		<td style="width:30%"><label for="message">{$LNG.ti_message}</label></td>
		<td style="width:70%"><textarea class="validate[required] form-control bg-dark text-white" id="message" name="message" rows="60" cols="8" style="height:100px;"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input class="btn btn-primary text-white btn-block w-100 p-0 m-0" type="submit" value="{$LNG.ti_submit}"></td>
	</tr>
	
	{/foreach}
</table>
</form>
{/block}
{block name="script" append}
<script>
$(document).ready(function() {
	$("#form").validationEngine('attach');
});
</script>
{/block}
