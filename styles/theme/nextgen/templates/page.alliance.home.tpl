{block name="title" prepend}{$LNG.lm_alliance}{/block}
{block name="content"}
<table class="table table-gow table-sm fs-12">
	<tr>
		<th colspan="2">{$LNG.al_your_ally}</th>
	</tr>
	{if $ally_image}
	<tr>
		<td colspan="2"><img style="max-width: 1024px;" src="{$ally_image}"></td>
	</tr>
	{/if}
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_ally_info_tag}</td>
		<td class="fs-12 fw-bold text-blue">{$ally_tag}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_ally_info_name}</td>
		<td class="fs-12 fw-bold text-blue">{$ally_name}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_ally_info_members}</td>
		<td class="fs-12 fw-bold text-blue">[{$ally_members} / {$ally_max_members}]</td>
	</tr>
	{if $rights.MEMBERLIST}
	<tr>
		<td colspan="2">
			<a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow w-100" href="?page=alliance&amp;mode=memberList">{$LNG.al_user_list}</a>
		</td>
	</tr>
	{/if}
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_rank}</td>
		<td class="fs-12 fw-bold text-blue">{$rankName}</td>
	</tr>
	{if $rights.ADMIN}
	<tr>
		<td colspan="2">
			<a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow w-100" href="?page=alliance&amp;mode=admin">{$LNG.al_manage_alliance}</a>
		</td>
	</tr>
	{/if}
    {if isModuleAvailable($smarty.const.MODULE_CHAT)}
	<tr>
		<td colspan="2">
			<a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow w-100" href="#" onclick="return Dialog.AllianceChat();">{$LNG.al_goto_chat}</a>
		</td>
	</tr>
    {/if}
	{if $rights.SEEAPPLY}
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_requests}</td>
		<td>
			<a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow w-100" href="?page=alliance&amp;mode=admin&amp;action=mangeApply">{$requests}</a>
		</td>
	</tr>
	{/if}
	{if $rights.ROUNDMAIL}
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.al_circular_message}</td>
		<td>
			<a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow w-100" href="game.php?page=alliance&mode=circular" onclick="return Dialog.open(this.href, 650, 300);">{$LNG.al_send_circular_message}</a>
		</td>
	</tr>
	{/if}
	{if $rights.EVENTS}
	<tr>
			<th colspan="2">{$LNG.al_events}</th>
		</tr>
		{if $ally_events}
			{foreach $ally_events as $member => $events}
				<tr>
					<td colspan="2">{$member}</td>
				</tr>
				{foreach $events as $index => $fleet}
				<tr>
					<td id="fleettime_{$index}">-</td>
					<td colspan="2">{$fleet.text}</td>
				</tr>
				{/foreach}
			{/foreach}
		{else}
			<tr>
				<td colspan="2">{$LNG.al_no_events}</td>
			</tr>
		{/if}
	{/if}
	<tr>
		<td colspan="2" style="height:100px" class="bbcode">{if $ally_description}{$ally_description}{else}{$LNG.al_description_message}{/if}</td>
	</tr>
	{if $ally_web}
	<tr>
		<td>{$LNG.al_web_text}</td>
		<td><a href="{$ally_web}">{$ally_web}</a></td>
	</tr>
	{/if}
	<tr>
		<th colspan="2">{$LNG.al_inside_section}</th>
	</tr>
	<tr>
		<td colspan="2" height="100" class="bbcode">{$ally_text}</td>
	</tr>
	<tr>
		<th colspan="2">{$LNG.al_diplo}</th>
	</tr>
	<tr>
		<td colspan="2">
		{if $DiploInfo}
			{if !empty($DiploInfo.0)}<b><u>{$LNG.al_diplo_level.0}</u></b><br><br>{foreach item=PaktInfo from=$DiploInfo.0}<a href="?page=alliance&mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a><br>{/foreach}<br>{/if}
		{if !empty($DiploInfo.1)}<b><u>{$LNG.al_diplo_level.1}</u></b><br><br>{foreach item=PaktInfo from=$DiploInfo.1}<a href="?page=alliance&mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a><br>{/foreach}<br>{/if}
		{if !empty($DiploInfo.2)}<b><u>{$LNG.al_diplo_level.2}</u></b><br><br>{foreach item=PaktInfo from=$DiploInfo.2}<a href="?page=alliance&mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a><br>{/foreach}<br>{/if}
		{if !empty($DiploInfo.3)}<b><u>{$LNG.al_diplo_level.3}</u></b><br><br>{foreach item=PaktInfo from=$DiploInfo.3}<a href="?page=alliance&mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a><br>{/foreach}<br>{/if}
			{if !empty($DiploInfo.4)}<b><u>{$LNG.al_diplo_level.4}</u></b><br><br>{foreach item=PaktInfo from=$DiploInfo.4}<a href="?page=alliance&mode=info&amp;id={$PaktInfo.1}">{$PaktInfo.0}</a><br>{/foreach}<br>{/if}
		{else}
			{$LNG.al_no_diplo}
		{/if}
		</td>
	</tr>
	<tr>
		<th colspan="2">{$LNG.pl_fightstats}</th>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_totalfight}</td>
		<td class="fs-12 fw-bold text-blue">{$totalfight|number}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_fightwon}</td>
		<td class="fs-12 fw-bold text-blue">{$fightwon|number} {if $totalfight}({round($fightwon / $totalfight * 100, 2)}%){/if}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_fightlose}</td>
		<td class="fs-12 fw-bold text-blue">{$fightlose|number} {if $totalfight}({round($fightlose / $totalfight * 100, 2)}%){/if}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_fightdraw}</td>
		<td class="fs-12 fw-bold text-blue">{$fightdraw|number} {if $totalfight}({round($fightdraw / $totalfight * 100, 2)}%){/if}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_unitsshot}</td>
		<td class="fs-12 fw-bold text-blue">{$unitsshot}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_unitslose}</td>
		<td class="fs-12 fw-bold text-blue">{$unitslose}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_dermetal}</td>
		<td class="fs-12 fw-bold text-blue">{$dermetal}</td>
	</tr>
	<tr>
		<td class="fs-12 fw-bold text-gow-gray">{$LNG.pl_dercrystal}</td>
		<td class="fs-12 fw-bold text-blue">{$dercrystal}</td>
	</tr>
</table>
{if !$isOwner}
<table class="table table-sm fs-12 table-gow">
	<tr>
		<th>{$LNG.al_leave_alliance}</th>
	</tr>
	<tr>
		<td>
			<a href="game.php?page=alliance&amp;mode=close" onclick="return confirm('{$LNG.al_leave_ally}');">
				<button class="btn btn-block btn-danger text-white p-1 fs-12 fw-bold">{$LNG.al_continue}</button>
			</a>
		</td>
	</tr>
</table>
{/if}
{/block}
