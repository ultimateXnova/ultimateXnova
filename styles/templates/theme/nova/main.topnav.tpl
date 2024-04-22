<div style="height:120px;" class="d-flex flex-column align-items-start justify-content-start col-9">
  <ul style="height:24px;padding:5px;" class="d-flex w-100 justify-content-start align-items-center list-unstyled fs-12 my-1 bg-purple">
    {if isModuleAvailable($smarty.const.MODULE_ATTACK_ALERT)}
    <div style="width:15px;" class="">
      <img id="attack_alert" src="" alt="">
    </div>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_NOTICE)}
    <li class="px-2 fs-12 hover-underline d-flex align-items-center h-100">
      <a href="javascript:OpenPopup('?page=notes', 'notes', 720, 300);">
        <i class="bi bi-journal-check fs-6"></i>
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_BUDDYLIST)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a href="game.php?page=buddyList">
        <i class="bi bi-people fs-6"></i>
      </a>
    </li>
    {/if}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100"><a href="game.php?page=settings"><i class="bi bi-gear fs-6"></i></a></li>
    {if isModuleAvailable($smarty.const.MODULE_MESSAGES)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="d-flex align-items-center text-decoration-none fs-12 m-0" href="?page=messages"><i class="bi bi-envelope-exclamation fs-6"></i>
        {nocache}
        {if $new_message > 0}
        <span id="newmes">&nbsp;(<span id="newmesnum">{$new_message}</span>)</span>
        {/if}
        {/nocache}
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_STATISTICS)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100"><a href="game.php?page=statistics"><i class="bi bi-graph-up-arrow"></i></a></li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SEARCH)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100"><a href="game.php?page=search"><i class="bi bi-search fs-6"></i></a></li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SUPPORT)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100"><a href="game.php?page=ticket"><i class="bi bi-info-circle fs-6"></i></a></li>
    {/if}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100"><a href="game.php?page=logout"><i class="bi bi-box-arrow-right fs-6"></i></a></li>
  </ul>

  <div style="height:96px;" class="d-flex w-100 bg-nova align-items-center">
    <div class="d-flex h-100 flex-column align-items-center justify-content-start px-2 border border-1 p-1 m-1">
       <img class="bg-light" src="{$avatar}" width="25" height="25"></a>
       <span>{$LNG.tech.615}</span>
       <a class="fs-12" href="game.php?page=settings">
         {$username}
       </a>
    </div>
    <div style="width:100px;" class="d-flex flex-column align-items-center justify-content-start">
    	<a href="game.php?page=overview">
        <img src="{$dpath}planeten/{$image}.jpg" width="50" height="50" alt="{$LNG.lm_overview}">
      </a>
      <select style="max-width:100px;" class="fs-12 fw-bold my-1 overflow-hidden" id="planetSelector">
        {foreach $PlanetSelect as $id => $currentPlanet}
          <option class="fs-12" value="{$id}" {if $current_pid == $id}selected{/if}>{$currentPlanet}</option>
        {/foreach}
      </select>
    </div>
    <div class="d-flex h-100">
      {foreach $resourceTable as $resourceID => $resourceData}
      <div style="width:150px;max-width:150px;overflow-y:hidden;margin:0 4px;padding-top:5px;" data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="
      <table class='table table-dark m-0'>
          <thead>
          </thead>
          <tbody>
            {if in_array($resourceID,array(901,902,903))}
            <tr>
              <td class='fs-12'>{$LNG.resource_available}:</td>
              <td class='fs-12'>{$resourceData.current|number}</td>
            </tr>
            <tr>
              <td class='fs-12'>{$LNG.resource_capacity}:</td>
              <td class='fs-12'>{$resourceData.max|number}</td>
            </tr>
            <tr>
              <td class='fs-12'>{$LNG.resource_production}:</td>
              <td class='fs-12 {if $resourceData.current < $resourceData.max}color-green{else}color-red{/if}'>
                {if $resourceData.current < $resourceData.max}
                {$resourceData.production|number}&nbsp;/&nbsp;{$LNG.short_hour}
                {else}
                0
                {/if}
              </td>
            </tr>
            {elseif $resourceID == 911}
            <tr>
              <td class='text-start text-yellow'>{$LNG.energy_available}:</td>
              <td class='text-end {if  ($resourceData.max + $resourceData.used) > 0}color-green{else}color-red{/if}'>{($resourceData.max + $resourceData.used)|number}&nbsp;/&nbsp;{$LNG.short_hour}</td>
            </tr>
            <tr>
              <td class='text-start text-yellow'>{$LNG.energy_used}:</td>
              <td class='color-red text-end'>{$resourceData.used|number}&nbsp;/&nbsp;{$LNG.short_hour}</td>
            </tr>
            <tr>
              <td class='text-start text-yellow'>{$LNG.energy_produced}:</td>
              <td class='color-green text-end'>{$resourceData.max|number}&nbsp;/&nbsp;{$LNG.short_hour}</td>
            </tr>
            {elseif $resourceID == 921}
            <tr>
              <td class='text-start text-yellow'>{$LNG.darkmatter_available}:</td>
              <td class='text-end'>{$resourceData.current|number}</td>
            </tr>
            {/if}
          </tbody>
        </table>" class="d-flex flex-column px-2 h-100 align-items-center justify-content-start scroll border-end border-dark" id="resource_mobile">
          <img class="user-select-none" onclick="return Dialog.info({$resourceID});" src="{$dpath}images/{$resourceData.name}.gif">
          <div class="fs-12 fw-bold text-yellow mt-1 user-select-none">{$LNG.tech.$resourceID}</div>
          <div class="w-100">
            {if !isset($resourceData.current)}
            {$resourceData.currentt = $resourceData.max + $resourceData.used}
              <div class="res_current fs-12 {if $resourceData.currentt > 0}color-green{else}color-red{/if}">
                {$resourceData.currentt|number}
              </div>
            {else}
              <div class="res_current user-select-none fs-12" id="current_{$resourceData.name}" data-real="{$resourceData.current}">{$resourceData.current|number}</div>
            {/if}
          </div>
      </div>
      {/foreach}
    </div>
</div>
</div>

{if !$vmode}
<script type="text/javascript">
var viewShortlyNumber	= {$shortlyNumber|json};
var vacation			= {$vmode};
$(function() {
{foreach $resourceTable as $resourceID => $resourceData}
{if isset($resourceData.production)}
	resourceTicker({
		available: {$resourceData.current|json},
		limit: [0, {$resourceData.max|json}],
		production: {$resourceData.production|json},
		valueElem: "current_{$resourceData.name}"
	}, true);
{/if}
{/foreach}
});
</script>
<script src="scripts/game/topnav.js"></script>
{if $hasGate}
  <script src="scripts/game/gate.js"></script>
{/if}
{/if}
