<div class="spyRaport">
	<div class="fs-11 text-center fw-bold text-white bg-dark py-1 px-2 my-2">
		<a class="text-decoration-none" href="game.php?page=galaxy&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}">{$title}</a>
	</div>
	{foreach $spyData as $Class => $elementIDs}
	<div class="d-flex flex-column">
	<span class="d-flex w-100 bg-light-black py-1 px-2 text-white fs-11">{$LNG.tech.$Class}</span>
	<div class="d-flex flex-wrap w-100">
		{foreach $elementIDs as $elementID => $amount}
		<div class="d-flex w-50 justify-content-between px-2 py-1">
			<a class="fs-11 hover-underline" href='#' onclick='return Dialog.info({$elementID})' data-bs-toggle="tooltip"
		data-bs-placement="left"
		data-bs-html="true" title="
		<table class='table-tooltip'>
			<thead>
				<tr>
					<th colspan='2'>{$LNG.tech.{$elementID}}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><img src='./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
				</tr>
				<tr>
					<td>{$LNG.shortDescription.$elementID}</td>
				</tr>
			</tbody>
		</table>
		">{$LNG.tech.$elementID}:</a>
		<span class="fs-11">{$amount|number}</span>
	</div>
	{/foreach}
</div>
	</div>
	{/foreach}
	<div class="d-flex flex-column bg-dark">
		<a class="fs-11 fw-bold w-100 color-blue text-center hover-underline" href="game.php?page=fleetTable&amp;galaxy={$targetPlanet.galaxy}&amp;system={$targetPlanet.system}&amp;planet={$targetPlanet.planet}&amp;planettype={$targetPlanet.planet_type}&amp;target_mission=1">{$LNG.type_mission_1}</a>
		<span class="fs-11 fw-bold w-100 color-blue text-center">
			{if $targetChance >= $spyChance}
			 {$LNG.sys_mess_spy_destroyed}
			{else}
			 {sprintf($LNG.sys_mess_spy_lostproba, $targetChance)}
			{/if}
		</span>
		{if $isBattleSim}
		<a class="fs-11 fw-bold w-100 color-blue text-center hover-underline" href="game.php?page=battleSimulator{foreach $spyData as $Class => $elementIDs}{foreach $elementIDs as $elementID => $amount}&amp;im[{$elementID}]={$amount}{/foreach}{/foreach}">{$LNG.fl_simulate}</a>
		{/if}
	</div>
</div>
