{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<form action="game.php?page=alliance&amp;mode=create&amp;action=send" method="POST">
	<table class="table table-sm table-gow fs-12">
		<tr>
			<th colspan=2>{$LNG.al_make_alliance}</th>
		</tr>
		<tr>
			<td>{$LNG.al_make_ally_tag_required}</td>
			<td>
				<input class="form-control bg-dark text-white" type="text" name="atag" size="8" maxlength="8" value="">
			</td>
		</tr>
		<tr>
			<td>{$LNG.al_make_ally_name_required}</th>
			<td>
				<input class="form-control bg-dark text-white" type="text" name="aname" size="20" maxlength="30" value="">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="btn btn-dark text-white p-1 fs-12 fw-bold" type="submit" value="{$LNG.al_make_submit}">
			</td>
		</tr>
	</table>
</form>
{/block}
