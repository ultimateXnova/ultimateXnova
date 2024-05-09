{block name="title" prepend}{if $mode == "defense"}{$LNG.lm_defenses}{else}{$LNG.lm_shipshard}{/if}{/block}
{block name="content"}
<script src="./scripts/base/avoid_submit_on_refresh.js" type="text/javascript"></script>

<script>
  function showItem(id){

    if ($('#item_big_' + id).hasClass('d-none')) {
      $('.buildItemBig').addClass('d-none');
      $('.buildItemSmall').removeClass('border-color-active').removeClass('border-color-passive');
      $('#item_big_' + id).removeClass('d-none');
      $('#item_small_' + id).addClass('border-color-active');
    }else {
      $('#item_big_' + id).addClass('d-none');
      $('#item_small_' + id).addClass('border-color-passive').removeClass('border-color-active');
    }

  }

</script>

{if !$NotBuilding}
<span class="d-flex justify-content-center rounded p-2 text-danger fw-bold bg-dark border border-2 border-danger mx-auto my-2 w-100" id="infobox">
	{$LNG.bd_building_shipyard}
</span>
{/if}


<div class="ItemsWrapper">

<div {if $mode == "defense"}style="background:url('{$dpath}images/defense.webp');"{else}style="background:url('{$dpath}images/hangar.webp');"{/if} class="itemShow d-flex justify-content-center align-items-center w-100 bg-black position-relative border-orange">
{foreach $elementList as $ID => $Element}
<div id="item_big_{$ID}" class="buildItemBig position-absolute top-0 left-0 d-none flex-column d-flex rounded border border-1 border-dark p-0 m-0 w-100">
  <div class="d-flex w-100 itemTop">
    <div class="d-flex align-items-start justify-content-center bg-black">
        <img class="mx-2 hover-pointer" onclick="return Dialog.info({$ID})" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="120" height="120">
    </div>
    <div class="d-flex flex-column w-100 bg-light-black">
      <div class="bg-blue d-flex justify-content-start mb-2 text-white fw-bold">
        <div class="d-flex px-2">
          <span class="fs-12 {if $Element.costOverflowTotal > 0}color-red hover-pointer{else}color-yellow{/if} p-0" {if $Element.costOverflowTotal > 0} data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="
            <table class='table fs-12'>
              <thead>
                <tr><th colspan='2' class='text-center'>{$LNG.bd_remaining}</th></tr>
              </thead>
              <tbody>
                {foreach $Element.costOverflow as $ResType => $ResCount}
                <tr>
                  <td>{$LNG.tech.$ResType}</td>
                  <td>{$ResCount|number}</td>
                </tr>
                {/foreach}
              </tbody>
            </table>"
            {/if}
            >
            {$LNG.tech.{$ID}}
          </span>
          <span class="fs-12 text-white" id="val_{$ID} p-0">
            &nbsp;( {$LNG.bd_available} {$Element.available|number} )
          </span>
        </div>
      </div>
      <div class="d-flex mx-2 justify-content-between">
        <div class="m-0 p-0">
          <span class="d-flex flex-column">
            {foreach $Element.costResources as $RessID => $RessAmount}
            <div class="d-flex align-items-center my-1">
              <img data-bs-toggle="tooltip"
              data-bs-placement="left"
              data-bs-html="true"
              title="{$LNG.tech.$RessID}" src='{$dpath}gebaeude/{$RessID}.{if $RessID >=600 && $RessID <= 699}jpg{else}gif{/if}'>
              <span class="mx-1 fs-11 {if $Element.costOverflow[$RessID] == 0}text-white{else}color-red{/if}">{$RessAmount|number}</span>
            </div>
            {/foreach}
          </span>
        </div>
        <div class="d-flex flex-column justify-content-start align-items-end">
          {if $ID == 212}
						<span class="fs-12 text-white">&nbsp;<span class="color-green">+{$SolarEnergy}</span>&nbsp;{$LNG.tech.911}</span>
					{/if}
						<div class="my-1">
						{if $Element.AlreadyBuild}
							<span class="fs-12 color-red">{$LNG.bd_protection_shield_only_one}</span>
						{elseif $NotBuilding && $Element.buyable}
            <form class="" action="game.php?page=shipyard&amp;mode={$mode}" method="post" id="s{$ID}">
							<input class="p-1 fs-11 text-white" type="text" name="fmenge[{$ID}]" id="input_{$ID}" size="3" maxlength="{$maxlength}" value="0" tabindex="{$smarty.foreach.FleetList.iteration}" >
							<input class="p-1 fs-11 text-white" type="button" value="{$LNG.bd_max_ships}" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}')">
							<input class="b p-1 fs-11 text-white button-upgrade" type="submit" value="{$LNG.bd_build_ships}">
            </form>
						{/if}
						</div>
						<span class="my-1 fs-12 text-right">{$LNG.fgf_time}&nbsp;:&nbsp;{pretty_time($Element.elementTime)}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex w-100 bg-light-black itemInfo">
    <p class="text-white fs-11 p-2">{$LNG.shortDescription[$ID]}</p>
  </div>
</div>
{/foreach}
</div>

<div class="d-flex flex-wrap justify-content-start bg-black pb-2 border-orange">
  <div class="d-flex w-100 justify-content-start m-2">
    <span class="color-yellow fs-12 fw-bolt">{$LNG.lm_shipshard}</span>
    <span class="color-yellow fs-12 fw-bolt">&nbsp;|&nbsp;{$LNG.st_points}&nbsp;[{if $mode == "fleet"}{$userFleetPoints}{else}{$userDefensePoints}{/if}]</span>
  </div>
  <div class="mx-2 d-flex flex-wrap">
    {foreach $elementList as $ID => $Element}
      <div class="buildItemSmall position-relative d-flex user-select-none" onclick="showItem({$ID})" id="item_small_{$ID}"
      data-bs-toggle="tooltip"
      data-bs-placement="top"
      data-bs-html="true"
      title="{$LNG.tech.{$ID}}
      {if !$Element.technologySatisfied && !empty($Element.requeriments)}
      <table class='table-tooltip'>
        <thead>
          <tr><th colspan='2' class='color-red'>{$LNG.tech_not_satisfied}</th></tr>
        </thead>
        <tbody>
          {foreach $Element.requeriments as $currentRequire}
          <tr>
            <td class='color-red'>
              <img class='mx-2 hover-pointer' src='{$dpath}gebaeude/{$currentRequire.requireID}.gif' alt='{$LNG.tech.{$currentRequire.requireID}}' width='30' height='30'>
            </td>
            <td class='color-red align-middle text-start'><span class='color-blue'>{$LNG.tech.{$currentRequire.requireID}}</span>&nbsp;({$currentRequire.neededLevel}&nbsp;/&nbsp;<span class='color-yellow'>{$currentRequire.currentLevel}</span>)</td>
          </tr>
          {/foreach}
        </tbody>
      </table>
      {/if}" >
      <div class="d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 color-yellow bg-dark fs-11 text-center ps-1">{shortly_number($Element.available)}</div>
      {if  !$Element.buyable || !$Element.technologySatisfied }
         <div class="black-screen d-flex position-absolute top-0 end-0 hover-pointer"></div>
         {/if}
        <img class="hover-pointer" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="80" height="80">
      </div>
    {/foreach}
  </div>
</div>
</div>

{if !empty($BuildList)}
<div class="ItemsWrapper d-flex flex-wrap justify-content-start w-100 mx-auto my-2 py-2 bg-black">
		<div id="bx" class="z my-2 text-center w-100 color-yellow"></div>
		<form class="d-flex flex-column" action="game.php?page=shipyard&mode={$mode}" method="post">
			<input type="hidden" name="action" value="delete">
			<select class="mx-2 p-2 rounded color-yellow fs-11" name="auftr[]" id="auftr" onchange="" multiple class="shipl">
				<option class="color-yellow">&nbsp;</option>
			</select>
			<span class="text-center text-danger fw-bold my-2">{$LNG.bd_cancel_warning}</span>
			<button style="width:auto;" class="btn btn-secondary text-white fw-bold" type="submit"/>{$LNG.bd_cancel_send}</button>
		</form>
		<span class="text-center my-2 color-red" id="timeleft"></span>
</div>
{/if}

{block name="script" append}
<script type="text/javascript">
data			= {$BuildList|json};
bd_operating	= '{$LNG.bd_operating}';
bd_available	= '{$LNG.bd_available}';
</script>

{if !empty($BuildList)}
<script src="scripts/base/bcmath.js"></script>
<script src="scripts/game/shipyard.js"></script>
<script type="text/javascript">
$(function() {
    ShipyardInit();
});

</script>
{/if}
{/block}

{/block}
