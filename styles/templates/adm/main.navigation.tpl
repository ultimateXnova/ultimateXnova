
<script>
$(document).ready(function(){
  $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#menu li").filter(function() {

      if ($(this).text().toLowerCase().indexOf(value) == -1) {

        if ($(this).hasClass('d-flex')) {
          $(this).removeClass('d-flex').addClass('d-none');
        }

      }else {
        if ($(this).hasClass('d-none')) {
          $(this).removeClass('d-none').addClass('d-flex');
        }
      }


    });
  });
});
</script>

<div id="leftmenu">
	<div class="adm-logo"><img src="./styles/resource/images/ultimatexnova.svg"></div>
	<input class="bg-black text-white py-0 my-1 form-control" style="height:38px;width:100%;" id="searchInput" type="text"  placeholder="search...">
	<ul class="bg-black d-flex flex-column p-0 m-0 adm-left-menu" id="menu">
		{if allowedTo('ShowInformationPage')}
			<li class="d-flex {if $currentPage == 'infos'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=infos">{$LNG.mu_game_info}</a>
			</li>
		{/if}
		{if allowedTo('ShowConfigBasicPage')}
			<li class="d-flex {if $currentPage == 'server'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=server" >{$LNG.mu_settings}</a>
			</li>
		{/if}
		{if allowedTo('ShowConfigUniPage')}
			<li class="d-flex {if $currentPage == 'universe'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=universe" >{$LNG.mu_unisettings}</a>
			</li>
		{/if}
    {if allowedTo('ShowColonySettingsPage')}
			<li class="d-flex {if $currentPage == 'colonySettings'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=colonySettings" >Colony Settings</a>
			</li>
		{/if}
    {if allowedTo('ShowRelocatePage')}
      <li class="d-flex {if $currentPage == 'relocate'}menu-active{/if}">
        <a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=relocate" >Relocate Settings</a>
      </li>
    {/if}
    {if allowedTo('ShowBostPage')}
			<li class="d-flex {if $currentPage == 'bots'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=bots" >Bots</a>
			</li>
		{/if}
    {if allowedTo('ShowPlanetFieldsPage')}
			<li class="d-flex {if $currentPage == 'planetFields'}menu-active{/if}">
				<a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=planetFields" >Planet Fields</a>
			</li>
		{/if}
    {if allowedTo('ShowExpeditionSettingsPage')}
      <li class="d-flex {if $currentPage == 'expedition'}menu-active{/if}">
        <a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=expedition" >Expedition Settings</a>
      </li>
    {/if}
		{if allowedTo('ShowChatConfigPage')}
    <li class="d-flex {if $currentPage == 'chat'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=chat" >{$LNG.mu_chat}</a>
    </li>
    {/if}
		{if allowedTo('ShowTeamspeakPage')}
    <li class="d-flex {if $currentPage == 'teamspeak'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=teamspeak" >{$LNG.mu_ts_options}</a>
    </li>
    {/if}
		{if allowedTo('ShowFacebookPage')}
    <li class="d-flex {if $currentPage == 'facebook'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=facebook" >{$LNG.mu_fb_options}</a>
    </li>
    {/if}
		{if allowedTo('ShowModulePage')}
    <li class="d-flex {if $currentPage == 'module'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=module" >{$LNG.mu_module}</a>
    </li>
    {/if}
		{if allowedTo('ShowDisclamerPage')}
    <li class="d-flex {if $currentPage == 'disclamer'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=disclamer" >{$LNG.mu_disclaimer}</a>
    </li>
    {/if}
		{if allowedTo('ShowStatsPage')}
    <li class="d-flex {if $currentPage == 'stats'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=stats" >{$LNG.mu_stats_options}</a>
    </li>
    {/if}
		{if allowedTo('ShowVertifyPage')}
    <li class="d-flex {if $currentPage == 'vertify'}menu-active{/if}">
      <a class="d-flexw-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=vertify" >{$LNG.mu_vertify}</a>
    </li>
    {/if}
		{if allowedTo('ShowCronjobPage')}
    <li class="d-flex {if $currentPage == 'cronjob'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=cronjob" >{$LNG.mu_cronjob}</a>
    </li>
    {/if}
		{if allowedTo('ShowDumpPage')}
    <li class="d-flex {if $currentPage == 'dump'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=dump" >{$LNG.mu_dump}</a>
    </li>
    {/if}
		{if allowedTo('ShowCreatorPage')}
    <li class="d-flex {if $currentPage == 'create'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1 text-decoration-none text-white fs-6" href="?page=create" >{$LNG.new_creator_title}</a>
    </li>
    {/if}
		{if allowedTo('ShowAccountEditorPage')}
    <li class="d-flex {if $currentPage == 'accounts'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=accounts" >{$LNG.mu_add_delete_resources}</a>
    </li>
    {/if}
		{if allowedTo('ShowBanPage')}
    <li class="d-flex {if $currentPage == 'banned'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=banned" >{$LNG.mu_ban_options}</a>
    </li>
    {/if}
		{if allowedTo('ShowGiveawayPage')}
    <li class="d-flex {if $currentPage == 'giveaway'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=giveaway" >{$LNG.mu_giveaway}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == 'online'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search&amp;search=online&amp;minimize=on" >{$LNG.mu_connected}</a>
    </li>
    {/if}
		{if allowedTo('ShowSupportPage')}
      <li class="d-flex {if $currentPage == 'support'}menu-active{/if}">
        <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=support" >{$LNG.mu_support}{if isset($supportticks)} ({$supportticks}){/if}</a>
      </li>
    {/if}
		{if allowedTo('ShowActivePage')}
    <li class="d-flex {if $currentPage == 'active'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=active" >{$LNG.mu_vaild_users}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == 'p_connect'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search&amp;search=p_connect&amp;minimize=on" >{$LNG.mu_active_planets}</a>
    </li>
    {/if}
		{if allowedTo('ShowFlyingFleetPage')}
    <li class="d-flex {if $currentPage == 'fleets'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=fleets" >{$LNG.mu_flying_fleets}</a>
    </li>
    {/if}
		{if allowedTo('ShowNewsPage')}
    <li class="d-flex {if $currentPage == 'news'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=news" >{$LNG.mu_news}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == 'users'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search&amp;search=users&amp;minimize=on" >{$LNG.mu_user_list}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == 'planet'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search&amp;search=planet&amp;minimize=on" >{$LNG.mu_planet_list}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == 'moon'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search&amp;search=moon&amp;minimize=on" >{$LNG.mu_moon_list}</a>
    </li>
    {/if}
		{if allowedTo('ShowMessageListPage')}
    <li class="d-flex {if $currentPage == 'messagelist'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=messagelist" >{$LNG.mu_mess_list}</a>
    </li>
    {/if}
		{if allowedTo('ShowAccountDataPage')}
    <li class="d-flex {if $currentPage == 'accountData'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=accountData" >{$LNG.mu_info_account_page}</a>
    </li>
    {/if}
		{if allowedTo('ShowSearchPage')}
    <li class="d-flex {if $currentPage == 'search' && $search == ''}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=search" >{$LNG.mu_search_page}</a>
    </li>
    {/if}
		{if allowedTo('ShowMultiIPPage')}
    <li class="d-flex {if $currentPage == 'multi'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=multi" >{$LNG.mu_multiip_page}</a>
    </li>
    {/if}
		{if allowedTo('ShowLogPage')}
    <li class="d-flex {if $currentPage == 'log'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=log" >{$LNG.mu_logs}</a>
    </li>
    {/if}
		{if allowedTo('ShowSendMessagesPage')}
    <li class="d-flex {if $currentPage == 'sendMessages'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=sendMessages" >{$LNG.mu_global_message}</a>
    </li>
    {/if}
		{if allowedTo('ShowPassEncripterPage')}
    <li class="d-flex {if $currentPage == 'passEncripter'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=passEncripter" >{$LNG.mu_md5_encripter}</a>
    </li>
    {/if}
		{if allowedTo('ShowStatUpdatePage')}
    <li class="d-flex {if $currentPage == 'statsUpdate'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=statsUpdate"  onClick=" return confirm('{$LNG.mu_mpu_confirmation}');">{$LNG.mu_manual_points_update}</a>
    </li>
    {/if}
		{if allowedTo('ShowClearCachePage')}
    <li class="d-flex {if $currentPage == 'clearCache'}menu-active{/if}">
      <a class="d-flex w-100 h-100 p-1  text-decoration-none text-white fs-6" href="?page=clearCache" >{$LNG.mu_clear_cache}</a>
    </li>
    {/if}
	
	</ul>
</div>
