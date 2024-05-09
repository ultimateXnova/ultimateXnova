{block name="title" prepend}{$LNG.lm_messages}{/block}
{block name="content"}
<table class="table table-sm table-gow my-1">
	<tr>
		<th class="text-center fs-12" colspan="6">{$LNG.mg_overview}<span id="loading" style="display:none;"> ({$LNG.loading})</span></th>
	</tr>
		{foreach $CategoryList as $CategoryID => $CategoryRow}
		{if ($CategoryRow@iteration % 6) === 1}<tr>{/if}
		{if $CategoryRow@last && ($CategoryRow@iteration % 6) !== 0}<td>&nbsp;</td>{/if}
		<td style="line-height:1;" class="text-center align-middle" style="word-wrap: break-word;color:{$CategoryRow.color};">
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$CategoryID}" style="color:{$CategoryRow.color};">{$LNG.mg_type.{$CategoryID}}</a>
		<br>
		<span class="fs-12" id="unread_{$CategoryID}">{$CategoryRow.unread}</span>
		<span class="fs-12">/</span>
		<span data-total-number="{$CategoryRow.total}" class="fs-12" id="total_{$CategoryID}">{$CategoryRow.total}</span>
		</td>
		{if $CategoryRow@last || ($CategoryRow@iteration % 6) === 0}</tr>{/if}
		{/foreach}
</table>
<form action="game.php?page=messages" method="post">
<input type="hidden" name="mode" value="action">
<input type="hidden" name="ajax" value="1">
<input type="hidden" name="messcat" value="{$MessID}">
<input type="hidden" name="side" value="{$messagePage}">
<table id="messagestable" class="table table-sm table-gow my-1">
	<tr>
		<th colspan="5" class="text-center fs-12">{$LNG.mg_message_title}</th>
	</tr>
	{if $MessID != 999}
	<tr>
		<td colspan="5" class="text-center align-middle">
			<select style="height:28px;" class="fs-12 py-1 bg-dark border border-secondary w-75" name="actionTop">
				<option value="readmarked">{$LNG.mg_read_marked}</option>
				<option value="readtypeall">{$LNG.mg_read_type_all}</option>
				<option value="readall">{$LNG.mg_read_all}</option>
				<option value="deletemarked">{$LNG.mg_delete_marked}</option>
				<option value="deleteunmarked">{$LNG.mg_delete_unmarked}</option>
				<option value="deletetypeall">{$LNG.mg_delete_type_all}</option>
				<option value="deleteall">{$LNG.mg_delete_all}</option>
			</select>
			<input style="height:28px;" class="text-white fw-bold fs-12 border border-1 border-dark" value="{$LNG.mg_confirm}" type="submit" name="submitTop">
		</td>

	</tr>
	{/if}
	<tr style="height: 20px;">
		<td colspan="5" class="text-center">
			<span class="fs-12">{$LNG.mg_page}:</span>
			{if $messagePage != 1}
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side=1">&laquo;</a>&nbsp;
			{/if}
			{if $messagePage > 5}..&nbsp;{/if}
			{for $site=1 to $maxPage}
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side={$site}">
				{if $site == $messagePage}
				<b>[{$site}]&nbsp;</b>
				{elseif ($site > $messagePage - 5 && $site < $messagePage+5)}
				[{$site}]&nbsp;
				{/if}
			</a>
			{/for}
			{if $messagePage < $maxPage-4}..&nbsp;{/if}
			{if $messagePage != $maxPage}&nbsp;
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side={$maxPage}">&raquo;</a>
			{/if}
		</td>
	</tr>
</table>
<table id="messagestable" class="table table-sm table-gow">
	<tr style="height:20px;">
		<td class="text-center fs-14 color-blue fw-bold" style="width:40px;">{$LNG.mg_action}</td>
		<td class="text-center fs-14 color-blue fw-bold">{$LNG.mg_date}</td>
		<td class="text-center fs-14 color-blue fw-bold">{if $MessID != 999}{$LNG.mg_from}{else}{$LNG.mg_to}{/if}</td>
		<td class="text-center fs-14 color-blue fw-bold">{$LNG.mg_subject}</td>
	</tr>
	{foreach $MessageList as $Message}
	<tr id="message_{$Message.id}" class="message_{$Message.id} message_head{if $MessID != 999 && $Message.unread == 1} mes_unread{/if}">
		<td class="text-center align-middle">
		{if $MessID != 999}
		 <input name="messageID[{$Message.id}]" value="1" type="checkbox">
		{/if}
		</td>
		<td class="text-center fs-12 align-middle">{$Message.time}</td>
		<td class="text-center fs-12 align-middle">{$Message.from}</td>
		<td class="text-center fs-12 align-middle">{$Message.subject}
		{if $Message.type == 1 && $MessID != 999}
		<a href="#" onclick="return Dialog.PM({$Message.sender}, Message.CreateAnswer('{$Message.subject}'));" title="{$LNG.mg_answer_to} {strip_tags($Message.from)}"><img src="{$dpath}img/m.gif" border="0"></a>
		{/if}
		</td>
		<td class="text-center align-middle">
			{if $MessID != 999}
			<a href="#" onclick="Message.deleteMessage({$Message.id}, {$Message.type});return false;">
				<img src="{$dpath}img/deletemsg.png">
			</a>
			{/if}
		</td>
	</tr>
	<tr class="message_{$Message.id} messages_body{if $MessID != 999 && $Message.unread == 1} mes_unread{/if}">
		<td class="fs-12" colspan="5" class="left">
		{$Message.text}
		</td>
	</tr>
	{/foreach}
	<tr style="height: 20px;">
		<td class="text-center" colspan="5">
			<span class="fs-12">{$LNG.mg_page}:</span>
			{if $messagePage != 1}
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side=1">&laquo;</a>
			&nbsp;
			{/if}
			{if $messagePage > 5}..&nbsp;{/if}
			{for $site=1 to $maxPage}
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side={$site}">
				{if $site == $messagePage}
				<b>[{$site}]&nbsp;</b>
				{elseif ($site > $messagePage-5 && $site < $messagePage+5)}
				[{$site}]&nbsp;{/if}
			</a>
			{/for}
			{if $messagePage < $maxPage-4}..&nbsp;{/if}{if $messagePage != $maxPage}&nbsp;
			<a class="fs-12 hover-underline" href="game.php?page=messages&category={$MessID}&side={$maxPage}">&raquo;</a>
			{/if}
		</td>
	</tr>
	{if $MessID != 999}
	<tr>
		<td class="text-center" colspan="5">
			<select style="height:28px;" class="fs-12 py-1 w-75 bg-dark border border-secondary" name="actionBottom">
				<option value="readmarked">{$LNG.mg_read_marked}</option>
				<option value="readtypeall">{$LNG.mg_read_type_all}</option>
				<option value="readall">{$LNG.mg_read_all}</option>
				<option value="deletemarked">{$LNG.mg_delete_marked}</option>
				<option value="deleteunmarked">{$LNG.mg_delete_unmarked}</option>
				<option value="deletetypeall">{$LNG.mg_delete_type_all}</option>
				<option value="deleteall">{$LNG.mg_delete_all}</option>
			</select>
			<input style="height:28px;" class="text-white fw-bold fs-12 border border-1 border-dark" value="{$LNG.mg_confirm}" type="submit" name="submitBottom">
		</td>
	</tr>
	{/if}
</table>
</form>
{/block}
