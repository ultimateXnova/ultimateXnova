
<div id="side-menu">
<div class="fixed">
        <ul id="left-menu">
 
    {if isModuleAvailable($smarty.const.MODULE_NOTICE)}<li><a href="javascript:OpenPopup('?page=notes', 'notes', 720, 300);"><i class="fas fa-sticky-note"></i>{$LNG.lm_notes}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_BUDDYLIST)}<li><a href="game.php?page=buddyList"><i class="fas fa-user-friends"></i>{$LNG.lm_buddylist}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_CHAT)}<li><a href="game.php?page=chat"><i class="fas fa-comments"></i>{$LNG.lm_chat}</a></li>{/if}
     {if isModuleAvailable($smarty.const.MODULE_MESSAGES)}<li><a href="game.php?page=messages">
     {if $new_message > 0}
     <i class="fas fa-envelope-open-text"></i>{$LNG.lm_messages} ({nocache}{$new_message}{/nocache})
        {/if}
     {if $new_message == 0}
     <i class="fas fa-envelope"></i>{$LNG.lm_messages}
        {/if}
     </a></li>
     {/if}
    {if isModuleAvailable($smarty.const.MODULE_STATISTICS)}<li><a href="game.php?page=statistics"><i class="fas fa-chart-line"></i>{$LNG.lm_statistics}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RECORDS)}<li><a href="game.php?page=records"><i class="fas fa-trophy"></i>{$LNG.lm_records}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_BATTLEHALL)}<li><a href="game.php?page=battleHall"><i class="fab fa-jedi-order"></i>{$LNG.lm_topkb}</a></li>{/if}
   
    <li><a href="game.php?page=settings"><i class="fas fa-cogs"></i>{$LNG.lm_options}</a></li>
    <li><a href="game.php?page=logout"><i class="fas fa-sign-out-alt"></i>{$LNG.lm_logout}</a></li>
    {if $authlevel > 0}<li><a href="./admin.php"><i class="fas fa-chess-king"></i>ADMIN </a></li>{/if}

</ul>
</div>
</div>
	
<menu>
		<div class="">
<ul id="menu">
    <li class="menu-separator"></li>
    <li><a href="game.php?page=overview"><i class="fas fa-eye"></i> {$LNG.lm_overview}</a></li>
    {if isModuleAvailable($smarty.const.MODULE_BUILDING)}<li><a href="game.php?page=buildings"><i class="fas fa-building"></i> {$LNG.lm_buildings}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_FLEET)}<li><a href="game.php?page=shipyard&amp;mode=fleet"><i class="fas fa-rocket"></i> {$LNG.lm_shipshard}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_DEFENSIVE)}<li><a href="game.php?page=shipyard&amp;mode=defense"><i class="fas fa-shield-alt"></i> {$LNG.lm_defenses}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RESEARCH)}<li><a href="game.php?page=research"><i class="fas fa-flask"></i> {$LNG.lm_research}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}<li><a href="game.php?page=fleetTable"><i class="fas fa-fighter-jet"></i> {$LNG.lm_fleet}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_GALAXY)}<li><a href="game.php?page=galaxy"><i class="fas fa-globe-europe"></i> {$LNG.lm_galaxy}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_IMPERIUM)}<li><a href="game.php?page=imperium"><i class="fas fa-crown"></i> {$LNG.lm_empire}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TECHTREE)}<li><a href="game.php?page=techtree"><i class="fas fa-satellite"></i> {$LNG.lm_technology}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_RESSOURCE_LIST)}<li><a href="game.php?page=resources"><i class="fas fa-tractor"></i> {$LNG.lm_resources}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_OFFICIER) || isModuleAvailable($smarty.const.MODULE_DMEXTRAS)}<li><a href="game.php?page=officier"><i class="far fa-star"></i> {$LNG.lm_officiers}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}<li><a href="game.php?page=trader"><i class="fas fa-cash-register"></i> {$LNG.lm_trader}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_FLEET_TRADER)}<li><a href="game.php?page=fleetDealer"><i class="fas fa-tools"></i> {$LNG.lm_fleettrader}</a></li>{/if}

    <li class="menu-separator"></li>
    {if isModuleAvailable($smarty.const.MODULE_ALLIANCE)}<li><a href="game.php?page=alliance"><i class="fas fa-handshake fas-red"></i> {$LNG.lm_alliance}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_FORUM)}{if !empty($hasBoard)}<li><a href="game.php?page=board" target="forum"><i class="fas fa-newspaper fas-red"></i> {$LNG.lm_forums}</a></li>{/if}{/if}
   {if isModuleAvailable($smarty.const.MODULE_SEARCH)}<li><a href="game.php?page=search"><i class="fas fa-search fas-red"></i> {$LNG.lm_search}</a></li>{/if}
     {if isModuleAvailable($smarty.const.MODULE_DISCORD)}<li><a href="{$discordUrl}" target="copy"> <i class="fab fa-discord fas-red"></i>Discord</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SUPPORT)}<li><a href="game.php?page=ticket"><i class="fas fa-life-ring fas-red"></i> {$LNG.lm_support}</a></li>{/if}
    <li><a href="game.php?page=questions"><i class="fas fa-question-circle fas-red"></i> {$LNG.lm_faq}</a></li>
    {if isModuleAvailable($smarty.const.MODULE_BANLIST)}<li><i class="fas fa-user-slash fas-red"></i> <a href="game.php?page=banList">{$LNG.lm_banned}</a></li>{/if}
    {if false}
    <li><a href="index.php?page=rules" target="rules"><i class="fas fa-balance-scale-right fas-red"></i> {$LNG.lm_rules}</a></li>{/if}
    {if isModuleAvailable($smarty.const.MODULE_SIMULATOR)}<li> <a href="game.php?page=battleSimulator"><i class="fas fa-crosshairs fas-red"></i> {$LNG.lm_battlesim}</a></li>{/if}

   </ul>
<div id="disclamer" class="no-mobile">
    {if $commit != ''}<a href="https://github.com/ultimateXnova/ultimateXnova/commit/{$commit}" target="copy">ultimateXnova {$commitShort}</a>{/if}
</div>
</div>
	</menu>