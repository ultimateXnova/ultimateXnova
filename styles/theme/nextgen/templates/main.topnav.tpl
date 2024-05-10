<div style="height:30px;" class="d-flex align-items-center justify-content-center bg-light-black">

  <ul class="d-flex justify-content-center align-items-center list-unstyled fs-12 py-3 my-0 mx-0 col-4">
    {if isModuleAvailable($smarty.const.MODULE_ATTACK_ALERT)}
    <div style="width:15px;" class="">
      <img id="attack_alert" src="" alt="">
    </div>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_NOTICE)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="javascript:OpenPopup('?page=notes', 'notes', 720, 300);" data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_notes}">
        <i style="font-size:20px;" class="bi bi-journal-check"></i>
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_BUDDYLIST)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=buddyList" data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_buddylist}">
        <i style="font-size:20px;" class="bi bi-people {if $page == 'buddyList'}text-danger{/if}"></i>
      </a>
    </li>
    {/if}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=settings"  data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_options}">
        <i style="font-size:20px;" class="bi bi-gear {if $page == 'settings'}text-danger{/if}"></i>
      </a>
    </li>
    {if isModuleAvailable($smarty.const.MODULE_MESSAGES)}

    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
    	<a class="text-white d-flex align-items-center text-decoration-none fs-12 m-0" href="?page=messages"   data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_messages}">
        <i style="font-size:20px;" class="bi bi-envelope-exclamation {if $page == 'messages'}text-danger{/if}"></i>
        {nocache}
        {if $new_message > 0}
        <span id="newmes">&nbsp;(<span id="newmesnum">{$new_message}</span>)</span>
        {/if}
        {/nocache}
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_STATISTICS)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=statistics"   data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_statistics}">
        <i style="font-size:20px;" class="bi bi-graph-up-arrow {if $page == 'statistics'}text-danger{/if}"></i>
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SEARCH)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=search"   data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_search}">
        <i style="font-size:20px;" class="bi bi-search {if $page == 'search'}text-danger{/if}"></i>
      </a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SUPPORT)}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=ticket"   data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_support}">
        <i style="font-size:20px;" class="bi bi-info-circle {if $page == 'ticket'}text-danger{/if}"></i>
      </a>
    </li>
    {/if}
    <li class="px-2 f-12 hover-underline d-flex align-items-center h-100">
      <a class="text-white" href="game.php?page=logout"   data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      data-bs-html="true" title="{$LNG.lm_logout}">
        <i style="font-size:20px;" class="bi bi-box-arrow-right"></i>
      </a>
    </li>
  </ul>
</div>

<div class="topnavWrapper d-flex align-items-center mx-auto my-2">
    <div style="height:80px;" class="d-flex flex-wrap col-5 justify-content-start align-items-end p-0">
    {foreach $resourceTable as $resourceID => $resourceData}
      {if $resourceData@iteration == 5}
    </div>
          <div class="d-flex col-2 align-items-center">
              <a href="game.php?page=overview">
                <img class="img-fluid px-1" src="styles/resource/images/ultimatexnova.svg" width="400px"/>
              </a>
          </div>
          <div style="height:80px;" class="d-flex flex-wrap col-5 justify-content-end align-items-start p-0">
       {/if}
          <div class="resourceWrapperOuter d-flex">

            <div class="d-flex align-items-center resourceWrapper w-100 h-100" data-bs-toggle="tooltip"
            data-bs-placement="bottom"
            data-bs-html="true" title="
            <table class='table-tooltip fs-11'>
                <thead>
                </thead>
                <tbody>
                  {if in_array($resourceID,array(901,902,903))}
                  <tr>
                    <td class='text-start text-yellow'>{$LNG.resource_available}:</td>
                    <td class='text-end'>{$resourceData.current|number}</td>
                  </tr>
                  <tr>
                    <td class='text-start text-yellow'>{$LNG.resource_capacity}:</td>
                    <td class='text-end'>{$resourceData.max|number}</td>
                  </tr>
                  <tr>
                    <td class='text-start text-yellow'>{$LNG.resource_production}:</td>
                    <td class='text-end {if $resourceData.current < $resourceData.max}color-green{else}color-red{/if}'>
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
              </table>">
              <div class="d-flex px-2">
                <img  onclick="return Dialog.info({$resourceID});" src="{$dpath}images/{$resourceData.name}.gif">
              </div>
              <div class="d-flex flex-column">
                <div class="fs-10 fw-bold text-yellow mt-1">{$LNG.tech.$resourceID}</div>
                <div>
                  {if !isset($resourceData.current)}
                  {$resourceData.currentt = $resourceData.max + $resourceData.used}
                    <div class="res_current fs-10 {if $resourceData.currentt > 0}color-green{else}color-red{/if}">
                      {$resourceData.currentt|number}
                    </div>
                  {else}
                    <div class="res_current fs-10" id="current_{$resourceData.name}" data-real="{$resourceData.current}">{$resourceData.current|number}</div>
                  {/if}
                </div>
              </div>
            </div>
          </div>

          {/foreach}
          <div class="resourceWrapperOuter d-flex">

          <div class="resourceWrapper d-flex align-items-center justify-content-center w-100 h-100">
             <img class="bg-light" src="{$avatar}" width="25" height="25"></a>
             <span class="fs-12 text-white">&nbsp;{$LNG.tech.615}&nbsp;</span>
             <a class="fs-12 text-white hover-underline" href="game.php?page=settings">{$username}</a>
          </div>
        </div>
        <div class="resourceWrapperOuter d-flex">

          <div class="resourceWrapper d-flex align-items-center justify-content-center fs-10 text-white w-100 h-100">
            <a class="fs-12 text-white hover-underline" href="game.php?page=questions">{$LNG.lm_faq}</a>
          </div>
        </div>
        <div class="resourceWrapperOuter d-flex">

          <div class="resourceWrapper servertime d-flex align-items-center justify-content-center fs-10 text-white w-100 h-100">
            {$servertime}
          </div>
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
{if $hasGate}<script src="scripts/game/gate.js"></script>{/if}
{/if}
