<tr>
	<th style="width:60px;">{$LNG.st_position}</th>
	<th>{$LNG.st_player}</th>
	<th>&nbsp;</th>
	<th class="text-center">{$LNG.st_alliance}</th>
	<th class="text-end">{$LNG.st_points}</th>
</tr>
{foreach name=RangeList item=RangeInfo from=$RangeList}
<tr>
	<td><a  data-bs-toggle="tooltip"
	data-bs-placement="left"
	data-bs-html="true" title="{if $RangeInfo.ranking == 0}<span style='color:#87CEEB'>*</span>{elseif $RangeInfo.ranking < 0}<span style='color:red'>-{$RangeInfo.ranking}</span>{elseif $RangeInfo.ranking > 0}<span style='color:green'>+{$RangeInfo.ranking}</span>{/if}">{$RangeInfo.rank}</a></td>
	<td>
		<a class="hover-underline hover-pointer color-white
		{if $RangeInfo.id != $CUser_id && !empty($RangeInfo.class)}
		{foreach $RangeInfo.class as $class}
		galaxy-short-{$class} galaxy-short
		{break}
		{/foreach}
		{/if}" href="#" onclick="return Dialog.Playercard({$RangeInfo.id}, '{$RangeInfo.name}');"{if $RangeInfo.id == $CUser_id} style="color:lime"{/if}>{$RangeInfo.name}&nbsp;</a>{if $RangeInfo.is_leader}<a style="color:yellow"  data-bs-toggle="tooltip"
	data-bs-placement="left"
	data-bs-html="true" title="
	<table>
		<thead>
			<tr>
				<th colspan='2' style='text-align:center;'>{$RangeInfo.ally_owner_range}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class='transparent'>{$RangeInfo.allyname}</td>
			</tr>
		</tbody>
	</table>"><i class="fas fa-trophy"></i></a>
	{/if}
	{if $RangeInfo.id != $CUser_id && !empty($RangeInfo.class)}
	{foreach $RangeInfo.class as $class}
	<span class="galaxy-short-{$class} galaxy-short">({$ShortStatus.$class})</span>
	{break}
	{/foreach}
	{/if}
</td>
	<td class="text-center">
		{if $RangeInfo.id != $CUser_id}
		<a href="#" onclick="return Dialog.PM({$RangeInfo.id});">
			<img src="{$dpath}img/m.gif" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="{$LNG.st_write_message}" alt="{$LNG.st_write_message}">
		</a>
		{/if}
	</td>
	<td class="text-center color-blue">
		{if $RangeInfo.allyid != 0}
		<a class="hover-underline hover-pointer" href="game.php?page=alliance&amp;mode=info&amp;id={$RangeInfo.allyid}">
			{if $RangeInfo.allyid == $CUser_ally}
			<span class="color-blue">{$RangeInfo.allyname}</span>
			{else}
			{$RangeInfo.allyname}
			{/if}
		</a>
		{else}-{/if}
	</td>
	<td class="text-end">
		{$RangeInfo.points}
	</td>
</tr>
{/foreach}
