<ul style="max-width:160px;" id="menu">
    <li class="menu-separator"></li>
    <li><a class="fs-14 fw-bold {if $page == 'overview'}active{/if}" href="game.php?page=overview">{$LNG.lm_overview}</a></li>
    {if isModuleAvailable($smarty.const.MODULE_BUILDING)}<li><a class="fs-14 fw-bold {if $page == 'buildings'}active{/if}" href="game.php?page=buildings">{$LNG.lm_buildings}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_FLEET)}<li><a class="fs-14 fw-bold {if $page == 'shipyard' && $mode =='fleet'}active{/if}" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_DEFENSIVE)}<li><a class="fs-14 fw-bold {if $page == 'shipyard' && $mode =='defense'}active{/if}" href="game.php?page=shipyard&amp;mode=defense">{$LNG.lm_defenses}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RESEARCH)}<li><a class="fs-14 fw-bold {if $page == 'research'}active{/if}" href="game.php?page=research">{$LNG.lm_research}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}<li><a class="fs-14 fw-bold {if $page == 'fleetTable'}active{/if}" href="game.php?page=fleetTable">{$LNG.lm_fleet}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_GALAXY)}<li><a class="fs-14 fw-bold {if $page == 'galaxy'}active{/if}" href="game.php?page=galaxy">{$LNG.lm_galaxy}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_IMPERIUM)}<li><a class="fs-14 fw-bold {if $page == 'imperium'}active{/if}" href="game.php?page=imperium">{$LNG.lm_empire}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_MESSAGES)}<li><a class="fs-14 fw-bold {if $page == 'messages'}active{/if}" href="game.php?page=messages">{$LNG.lm_messages}{nocache}{if $new_message > 0}<span id="newmes"> (<span id="newmesnum">{$new_message}</span>)</span>{/if}{/nocache}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TECHTREE)}<li><a class="fs-14 fw-bold {if $page == 'techtree'}active{/if}" href="game.php?page=techtree">{$LNG.lm_technology}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RESSOURCE_LIST)}<li><a class="fs-14 fw-bold {if $page == 'resources'}active{/if}" href="game.php?page=resources">{$LNG.lm_resources}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_OFFICIER) || isModuleAvailable($smarty.const.MODULE_DMEXTRAS)}<li><a  class="fs-14 fw-bold {if $page == 'officier'}active{/if}" href="game.php?page=officier">{$LNG.lm_officiers}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}<li><a class="fs-14 fw-bold {if $page == 'trader'}active{/if}" href="game.php?page=trader">{$LNG.lm_trader}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_FLEET_TRADER)}<li><a class="fs-14 fw-bold {if $page == 'fleetDealer'}active{/if}" href="game.php?page=fleetDealer">{$LNG.lm_fleettrader}</a></li>{/if}

    <li class="menu-separator"></li>
    {if isModuleAvailable($smarty.const.MODULE_ALLIANCE)}<li><a class="fs-14 fw-bold" href="game.php?page=alliance">{$LNG.lm_alliance}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_FORUM)}{if !empty($hasBoard)}<li><a class="fs-14 fw-bold" href="game.php?page=board" target="forum">{$LNG.lm_forums}</a></li>{/if}{/if}
    {if isModuleAvailable($smarty.const.MODULE_STATISTICS)}<li><a class="fs-14 fw-bold" href="game.php?page=statistics">{$LNG.lm_statistics}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RECORDS)}<li><a class="fs-14 fw-bold" href="game.php?page=records">{$LNG.lm_records}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_BATTLEHALL)}<li><a class="fs-14 fw-bold" href="game.php?page=battleHall">{$LNG.lm_topkb}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SEARCH)}<li><a class="fs-14 fw-bold" href="game.php?page=search">{$LNG.lm_search}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_CHAT)}<li><a class="fs-14 fw-bold" href="game.php?page=chat">{$LNG.lm_chat}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_DISCORD)}<li><a class="fs-14 fw-bold" href="{$discordUrl}" target="copy">Discord</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SUPPORT)}<li><a class="fs-14 fw-bold" href="game.php?page=ticket">{$LNG.lm_support}</a></li>{/if}
    <li><a class="fs-14 fw-bold" href="game.php?page=questions">{$LNG.lm_faq}</a></li>
    {if isModuleAvailable($smarty.const.MODULE_BANLIST)}<li><a class="fs-14 fw-bold" href="game.php?page=banList">{$LNG.lm_banned}</a></li>{/if}
    {if false}
    <li><a class="fs-14 fw-bold" href="index.php?page=rules" target="rules">{$LNG.lm_rules}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SIMULATOR)}<li><a class="fs-14 fw-bold" href="game.php?page=battleSimulator">{$LNG.lm_battlesim}</a></li>{/if}

    <li class="menu-separator"></li>
    {if isModuleAvailable($smarty.const.MODULE_NOTICE)}<li><a class="fs-14 fw-bold" href="javascript:OpenPopup('?page=notes', 'notes', 720, 300);">{$LNG.lm_notes}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_BUDDYLIST)}<li><a class="fs-14 fw-bold" href="game.php?page=buddyList">{$LNG.lm_buddylist}</a></li>{/if}
    <li><a class="fs-14 fw-bold" href="game.php?page=settings">{$LNG.lm_options}</a></li>
    <li><a class="fs-14 fw-bold" href="game.php?page=logout">{$LNG.lm_logout}</a></li>
    {if $authlevel > 0}<li><a class="fs-14 fw-bold" href="./admin.php" style="color:lime">{$LNG.lm_administration} ({$VERSION})</a></li>{/if}
</ul>
<div id="disclamer" class="no-mobile">
    {if $commit != ''}<a href="https://github.com/ultimateXnova/ultimateXnova/commit/{$commit}" target="copy">ultimateXnova {$commitShort}</a>{/if}
</div>
