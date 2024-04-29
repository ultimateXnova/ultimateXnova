{block name="title" prepend}{$LNG.lm_buildings}{/block}
{block name="content"}

{if $messages}
	<div class="message"><a href="?page=messages">{$messages}</a></div>
{/if}
{if !empty($Queue)}
<div id="buildlist" class="infos1">

		{foreach $Queue as $List}
		{$ID = $List.element}
		<div class="buildb">

				{$List@iteration}.:
				{if !($isBusy.research && ($ID == 6 || $ID == 31)) && !($isBusy.shipyard && ($ID == 15 || $ID == 21)) && $RoomIsOk && $CanBuildElement && $BuildInfoList[$ID].buyable}
				<form class="build_form" action="game.php?page=buildings" method="post">
					<input type="hidden" name="cmd" value="insert">
					<input type="hidden" name="building" value="{$ID}">
					<button type="submit" class="build_submit onlist">{$LNG.tech.{$ID}} {$List.level}{if $List.destroy} {$LNG.bd_dismantle}{/if}</button>
				</form>
				{else}{$LNG.tech.{$ID}} {$List.level} {if $List.destroy}{$LNG.bd_dismantle}{/if}{/if}
				{if $List@first}
				<br><br><div id="progressbar" data-time="{$List.resttime}"></div></div>
			<div class="bulida">
				<div id="time" data-time="{$List.time}"><br></div>
				<form action="game.php?page=buildings" method="post" class="build_form">
					<input type="hidden" name="cmd" value="cancel">
					<button type="submit" class="build_submit onlist">{$LNG.bd_cancel}</button>
				</form>
				{else}
			</div><div class="bulida">
				<form action="game.php?page=buildings" method="post" class="build_form">
					<input type="hidden" name="cmd" value="remove">
					<input type="hidden" name="listid" value="{$List@iteration}">
					<button type="submit" class="build_submit onlist">{$LNG.bd_cancel}</button>
				</form>
				{/if}
				<br><span style="color:lime" data-time="{$List.endtime}" class="timer">{$List.display}</span>
			</div>
	{/foreach}
</div >
{/if}

	<div>
<div class="d-flex bg-purple p-2">
	<button class="btn btn-sm btn-info text-white fs-12 fw-bold mx-1 color-black" id="btn1">Mining</button>
	<button class="btn btn-sm btn-info text-white fs-12 fw-bold mx-1 color-black" id="btn2">Other</button>
	<button class="btn btn-sm btn-info text-white fs-12 fw-bold mx-1 color-black" id="btn3">All</button>
</div>

{foreach $BuildInfoList as $ID => $Element}
{if in_array($ID,array(1,2,3,4,12,22,23,24))}
	<div class="infos scroll">
		<div class="buildn d-flex justify-content-center">
			<a class="fs-12 user-select-none" href="#" onclick="return Dialog.info({$ID})">{$LNG.tech.{$ID}}&nbsp;</a>
			{if $Element.level > 0}
				<span class="fs-12 user-select-none">(&nbsp;{$LNG.bd_lvl}&nbsp;{$Element.level}&nbsp;/&nbsp;{$Element.maxLevel}&nbsp;)</span>
			{/if}
		</div>
		<div class="buildl">
			<a href="#" onclick="return Dialog.info({$ID})">
				<img style="float: left;" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="120" height="120">
			</a>
			{if $Element.costOverflowTotal > 0}
			<div style="overflow-y:hidden;" class="d-flex flex-column justify-content-start p-1 scroll">
				<span class="fs-12 text-start">{$LNG.bd_remaining}</span>
				{foreach $Element.costOverflow as $ResType => $ResCount}
				<div class="d-flex">
					<a href='#' onclick="return Dialog.info({$ResType});"
					data-bs-toggle="tooltip"
					data-bs-placement="left"
					data-bs-html="true"
					title="<table>
									<tr>
										<th>{$LNG.tech.{$ResType}}</th>
									</tr>
									<tr>
										<table class='hoverinfo'>
											<tr>
												<td>{$LNG.shortDescription.$ResType}</td>
											</tr>
										</table>
									</tr>
								</table>"
					>{$LNG.tech.{$ResType}}:&nbsp;
					</a>
					<span style="font-weight:700">{$ResCount|number}</span>
				</div>
				{/foreach}
			</div>
			{/if}
			{if !empty($Element.infoEnergy)}
				{$LNG.bd_next_level}<br>
				{$Element.infoEnergy}<br>
			{/if}
		</div>
		<div class="buildl">
		<div class="d-flex flex-column">
		  {foreach $Element.costResources as $RessID => $RessAmount}
			<div class="d-flex justify-content-center">
				<a href='#'
					 onclick="return Dialog.info({$RessID});"
					 data-bs-toggle="tooltip"
					 data-bs-placement="left"
					 data-bs-html="true"
					 title="<table><tr><th>{$LNG.tech.{$RessID}}</th></tr><tr><table class='hoverinfo'><tr><td><img src='{$dpath}gebaeude/{$RessID}.{if $RessID >=600 && $RessID <= 699}jpg{else}gif{/if}'></td><td>{$LNG.shortDescription.$RessID}</td></tr></table></tr></table>">
					 {$LNG.tech.{$RessID}}:&nbsp;
				 </a>
				 <b>
					 <span style="color:{if $Element.costOverflow[$RessID] == 0}lime{else}#ffd600{/if}">
						 {$RessAmount|number}
					 </span>
				 </b>
			</div>
			{/foreach}
				</div>
				<br><br>

					{if $Element.maxLevel == $Element.levelToBuild}
						<span style="color:#ffd600">{$LNG.bd_maxlevel} || <button>End Game</button></span>
					{elseif ($isBusy.research && ($ID == 6 || $ID == 31)) || ($isBusy.shipyard && ($ID == 15 || $ID == 21))}
						<span style="color:#ffd600">{$LNG.bd_working}</span>
					{else}
						{if $RoomIsOk}
							{if $CanBuildElement && $Element.buyable}
							<form action="game.php?page=buildings" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="building" value="{$ID}">
								<button type="submit" class="build_submit">{if $Element.level == 0 && $Element.levelToBuild == 0}{$LNG.bd_build}{else}{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}{/if}</button>
							</form>
							{else}
							<span style="color:#ffd600">{if $Element.level == 0 && $Element.levelToBuild == 0}{$LNG.bd_build}{else}{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}{/if}</span>
							{/if}
						{else}
						<span style="color:#ffd600">{$LNG.bd_no_more_fields}</span>
						{/if}
					{/if}

				<br>
						{$LNG.fgf_time}:{$Element.elementTime|time}
{if $Element.level > 0}
							{if $ID == 43}<a href="#" onclick="return Dialog.info({$ID})">{$LNG.bd_jump_gate_action}</a>{/if}
							{if ($ID == 44 && !$HaveMissiles) ||  $ID != 44}<br><a class="tooltip_sticky" data-tooltip-content="
								{* Start Destruction Popup *}
								<table style='width:300px'>
									<tr>
										<th colspan='2'>{$LNG.bd_price_for_destroy} {$LNG.tech.{$ID}} {$Element.level}</th>
									</tr>
									{foreach $Element.destroyResources as $ResType => $ResCount}
									<tr>
										<td>{$LNG.tech.{$ResType}}</td>
										<td><span style='color:{if empty($Element.destroyOverflow[$RessID])}lime{else}#ffd600{/if}'>{$ResCount|number}</span></td>
									</tr>
									{/foreach}
									<tr>
										<td>{$LNG.bd_destroy_time}</td>
										<td>{$Element.destroyTime|time}</td>
									</tr>
									<tr>
										<td colspan='2'>
											<form action='game.php?page=buildings' method='post' class='build_form'>
												<input type='hidden' name='cmd' value='destroy'>
												<input type='hidden' name='building' value='{$ID}'>
												<button type='submit' class='build_submit onlist'>{$LNG.bd_dismantle}</button>
											</form>
										</td>
									</tr>
								</table>
								{* End Destruction Popup *}
								">{$LNG.bd_dismantle}</a>{/if}
						{else}
							&nbsp;
						{/if}
	</div>
</div>
 {else}
<div class="infoso scroll">
	 <div class="buildn">
		 <a href="#" onclick="return Dialog.info({$ID})">{$LNG.tech.{$ID}}</a>
		 {if $Element.level > 0}
		 (
		 {$LNG.bd_lvl} {$Element.level}
		 {if $Element.maxLevel != 255}/{$Element.maxLevel}{/if}
		 )
		 {/if}
	 </div>
	 <div class="buildl">
			<a href="#" onclick="return Dialog.info({$ID})">
				<img style="float: left;" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="120" height="120">
			</a>
			{if $Element.costOverflowTotal > 0}
			<div style="overflow-y:hidden;" class="d-flex flex-column p-1 justify-content-start scroll">
				<span class="fs-12 text-start">{$LNG.bd_remaining}</span>
				{foreach $Element.costOverflow as $ResType => $ResCount}
				<div class="d-flex">
					<a href='#'
					   onclick="return Dialog.info({$ResType});"
						 data-bs-toggle="tooltip"
	           data-bs-placement="left"
	           data-bs-html="true"
						 title="<table><tr><th>{$LNG.tech.{$ResType}}</th></tr><tr><table class='hoverinfo'><tr><td>{$LNG.shortDescription.$ResType}</td></tr></table></tr></table>">
						 {$LNG.tech.{$ResType}}:&nbsp;
					 </a>
					 <span style="font-weight:700">{$ResCount|number}</span>
				</div>
				{/foreach}
			</div>
			{/if}
{if !empty($Element.infoEnergy)}
	{$LNG.bd_next_level}
	{$Element.infoEnergy}
{/if}
</div>
<div class="buildl">
	<div class="d-flex flex-column justify-content-center">
		{foreach $Element.costResources as $RessID => $RessAmount}
		<div class="d-flex justify-content-center">
			<a href='#'
				 onclick="return Dialog.info({$RessID});"
				 data-bs-toggle="tooltip"
				 data-bs-placement="left"
				 data-bs-html="true"
				 title="<table><tr><th>{$LNG.tech.{$RessID}}</th></tr><tr><table class='hoverinfo'><tr><td><img src='{$dpath}gebaeude/{$RessID}.{if $RessID >=600 && $RessID <= 699}jpg{else}gif{/if}'></td><td>{$LNG.shortDescription.$RessID}</td></tr></table></tr></table>">
				 {$LNG.tech.{$RessID}}:&nbsp;
			 </a>
			 <b>
				 <span style="color:{if $Element.costOverflow[$RessID] == 0}lime{else}#ffd600{/if}">{$RessAmount|number}</span>
			 </b>
		</div>
		{/foreach}
	</div>

					{if $Element.maxLevel == $Element.levelToBuild}
						<span style="color:#ffd600">{$LNG.bd_maxlevel}</span>
					{elseif ($isBusy.research && ($ID == 6 || $ID == 31)) || ($isBusy.shipyard && ($ID == 15 || $ID == 21))}
						<span style="color:#ffd600">{$LNG.bd_working}</span>
					{else}
						{if $RoomIsOk}
							{if $CanBuildElement && $Element.buyable}
							<form action="game.php?page=buildings" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="building" value="{$ID}">
								<button type="submit" class="build_submit">{if $Element.level == 0 && $Element.levelToBuild == 0}{$LNG.bd_build}{else}{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}{/if}</button>
							</form>
							{else}
							<span style="color:#ffd600">{if $Element.level == 0 && $Element.levelToBuild == 0}{$LNG.bd_build}{else}{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}{/if}</span>
							{/if}
						{else}
						<span style="color:#ffd600">{$LNG.bd_no_more_fields}</span>
						{/if}
					{/if}

				<br>
						{$LNG.fgf_time}:{$Element.elementTime|time}
{if $Element.level > 0}
							{if $ID == 43}<a href="#" onclick="return Dialog.info({$ID})">{$LNG.bd_jump_gate_action}</a>{/if}
							{if ($ID == 44 && !$HaveMissiles) ||  $ID != 44}<br><a class="tooltip_sticky" data-tooltip-content="
								{* Start Destruction Popup *}
								<table style='width:300px'>
									<tr>
										<th colspan='2'>{$LNG.bd_price_for_destroy} {$LNG.tech.{$ID}} {$Element.level}</th>
									</tr>
									{foreach $Element.destroyResources as $ResType => $ResCount}
									<tr>
										<td>{$LNG.tech.{$ResType}}</td>
										<td><span style='color:{if empty($Element.destroyOverflow[$RessID])}lime{else}#ffd600{/if}'>{$ResCount|number}</span></td>
									</tr>
									{/foreach}
									<tr>
										<td>{$LNG.bd_destroy_time}</td>
										<td>{$Element.destroyTime|time}</td>
									</tr>
									<tr>
										<td colspan='2'>
											<form action='game.php?page=buildings' method='post' class='build_form'>
												<input type='hidden' name='cmd' value='destroy'>
												<input type='hidden' name='building' value='{$ID}'>
												<button type='submit' class='build_submit onlist'>{$LNG.bd_dismantle}</button>
											</form>
										</td>
									</tr>
								</table>
								{* End Destruction Popup *}
								">{$LNG.bd_dismantle}</a>{/if}
						{else}
							&nbsp;
						{/if}
					</div>
</div>
{/if}


	{/foreach}
</div>
{/block}
