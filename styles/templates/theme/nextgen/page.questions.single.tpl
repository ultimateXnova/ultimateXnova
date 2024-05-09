{block name="title" prepend}{$LNG.lm_faq}{/block}
{block name="content"}
<table class="table table-gow table-sm fs-12 text-white">
	<tr>
		<th>{$LNG.faq_overview}</th>
	</tr>
	<tr>
		<th>{$questionRow.title}</th>
	</tr>
	<tr>
		<td class="left text-white">
		{$questionRow.body}
		</td>
	</tr>
	<tr>
		<th class="text-center">
			<a class="btn btn-primary text-white px-2 py-0 mx-auto" href="game.php?page=questions">{$LNG.al_back}</a>
		</th>
	</tr>
</table>
{/block}
