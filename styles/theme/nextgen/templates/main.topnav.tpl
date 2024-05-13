<div class="dark-blur-bg top-bar ">
  <div class="uk-container">
    <div class="uk-navbar-center">
      <ul class="uk-navbar-nav">
              <!--{if isModuleAvailable($smarty.const.MODULE_ATTACK_ALERT)}
                <div style="width:15px;" class="">
                <img id="attack_alert" src="" alt="">
              </div>
              {/if} -->
              {if isModuleAvailable($smarty.const.MODULE_NOTICE)}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="javascript:OpenPopup('?page=notes', 'notes', 720, 300);" data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_notes}">
                  <i style="font-size:20px;" class="bi bi-journal-check"></i>
                </a>
              </li>
              {/if}
              {if isModuleAvailable($smarty.const.MODULE_BUDDYLIST)}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=buddyList" data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_buddylist}">
                  <i style="font-size:20px;" class="bi bi-people {if $page == 'buddyList'}text-danger{/if}"></i>
                </a>
              </li>
              {/if}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=settings"  data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_options}">
                  <i style="font-size:20px;" class="bi bi-gear {if $page == 'settings'}text-danger{/if}"></i>
                </a>
              </li>
              {if isModuleAvailable($smarty.const.MODULE_MESSAGES)}

              <li class="hover-underline d-flex align-items-center h-100">
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
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=statistics"   data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_statistics}">
                  <i style="font-size:20px;" class="bi bi-graph-up-arrow {if $page == 'statistics'}text-danger{/if}"></i>
                </a>
              </li>
              {/if}
              {if isModuleAvailable($smarty.const.MODULE_SEARCH)}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=search"   data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_search}">
                  <i style="font-size:20px;" class="bi bi-search {if $page == 'search'}text-danger{/if}"></i>
                </a>
              </li>
              {/if}
              {if isModuleAvailable($smarty.const.MODULE_SUPPORT)}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=ticket"   data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_support}">
                  <i style="font-size:20px;" class="bi bi-info-circle {if $page == 'ticket'}text-danger{/if}"></i>
                </a>
              </li>
              {/if}
              <li class="hover-underline d-flex align-items-center h-100">
                <a class="text-white" href="game.php?page=logout"   data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                data-bs-html="true" title="{$LNG.lm_logout}">
                  <i style="font-size:20px;" class="bi bi-box-arrow-right"></i>
                </a>
              </li>
            </ul>
    </div>
  </div>
</div>
</div>
<div class="dark-blur-bg menu-container box-shadow-large">
	<div class="uk-container">
    <div class="uk-grid" uk-grid>
      <div class="uk-width-1-1 uk-width-1-5@m uk-text-center"><a href="game.php?page=overview"><img class="logo" src="styles/resource/images/ultimatexnova.svg"/></a></div>
      <div class="uk-width-1-1 uk-flex-middle uk-flex-center uk-width-4-5@m uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m uk-grid-small uk-grid-row-collapse uk-padding-top-remove uk-margin-remove-top " uk-grid>
        <!-- New Resource panel -->
       
        {foreach $resourceTable as $resourceID => $resourceData}
          {if !isset($resourceData.current)}
            {$resourceData.currentt = $resourceData.max + $resourceData.used}
          {else}
            {$resourceData.currentt = 1}
          {/if}
          <div class="">
            <div class="uk-flex-middle resource {$resourceData.name} {if $resourceData.currentt > 0}resource-positive{else}resource-negative{/if} 
              {if in_array($resourceID,array(901,902,903))}  {$resourceData.production}
                {if $resourceData.current >= $resourceData.max }resource-negative{/if}
              {/if}
                ">
          
              <!-- Picture -->
              <div class="resource-picture">
                <img onclick="return Dialog.info({$resourceID});" src="{$dpath}img/resources/{$resourceData.name}.webp">
              </div>
              <!-- Text -->
              <div class="resource-content">
                <div class="resource-name">
                {$LNG.tech.$resourceID}
                </div>
              
                {if !isset($resourceData.current)}
                {$resourceData.currentt = $resourceData.max + $resourceData.used}
                  <div class="res_current fs-10 {if $resourceData.currentt > 0}color-green{else}color-red{/if}">
                    {$resourceData.currentt|number}
                  </div>
                {else}
                  <div class="res_current fs-10" id="current_{$resourceData.name}" data-real="{$resourceData.current}">{$resourceData.current|number}</div>
                {/if}
              </div>
              <!-- Tooltip -->
              <div class="resource-tooltip">
              {if in_array($resourceID,array(901,902,903))}
                <!--{$LNG.resource_available}: {$resourceData.current|number}<br>-->
                {$LNG.resource_capacity}: {$resourceData.max|number}<br>
                {$LNG.resource_production}: <span class="{if $resourceData.current < $resourceData.max}color-green{else}color-red{/if}">
                  {if $resourceData.current < $resourceData.max}
                  {$resourceData.production|number}&nbsp;/&nbsp;{$LNG.short_hour}
                  {else}
                  0
                  {/if}
              {elseif $resourceID == 911}
              
                {$LNG.energy_used}: {$resourceData.used|number}&nbsp;/&nbsp;{$LNG.short_hour}<br>
                {$LNG.energy_produced}: {$resourceData.max|number}&nbsp;/&nbsp;{$LNG.short_hour}<br>
              {elseif $resourceID == 921}
                
              {/if}
              </div>
            </div>
          </div>
        {/foreach}
        
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
