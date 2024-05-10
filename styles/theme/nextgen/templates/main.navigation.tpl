<div class="dark-blur-bg box-border box-shadow-large main-menu-container">
<ul class="main-menu">
    <li>
      <a class="{if $page == 'overview'}menuActive{/if}" href="game.php?page=overview">{$LNG.lm_overview}</a>
    </li>
    {if isModuleAvailable($smarty.const.MODULE_BUILDING)}
    <li>
      <a class="{if $page == 'buildings'}menuActive{/if}"  href="game.php?page=buildings">{$LNG.lm_buildings}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_FLEET)}
    <li>
      <a class="{if $page == 'shipyard' && $mode == 'fleet'}menuActive{/if}" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_DEFENSIVE)}
    <li>
      <a class="{if $page == 'shipyard' && $mode == 'defense'}menuActive{/if}" href="game.php?page=shipyard&amp;mode=defense">{$LNG.lm_defenses}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_RESEARCH)}
    <li>
      <a class="{if $page == 'research'}menuActive{/if}" href="game.php?page=research">{$LNG.lm_research}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}
    <li>
      <a class="{if $page == 'fleetTable'}menuActive{/if}" href="game.php?page=fleetTable">{$LNG.lm_fleet}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_GALAXY)}
    <li>
      <a class="{if $page == 'galaxy'}menuActive{/if}" href="game.php?page=galaxy">{$LNG.lm_galaxy}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_IMPERIUM)}
    <li>
      <a target="_blank" class="{if $page == 'imperium'}menuActive{/if}" href="game.php?page=imperium">{$LNG.lm_empire}</a>
    </li>
    {/if}

    {if isModuleAvailable($smarty.const.MODULE_TECHTREE)}
    <li>
      <a class="{if $page == 'techtree'}menuActive{/if}" href="game.php?page=techtree">{$LNG.lm_technology}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_RESSOURCE_LIST)}
    <li>
      <a class="{if $page == 'resources'}menuActive{/if}" href="game.php?page=resources">{$LNG.lm_resources}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_OFFICIER) || isModuleAvailable($smarty.const.MODULE_DMEXTRAS)}
    <li>
      <a class="{if $page == 'officier'}menuActive{/if}" href="game.php?page=officier">{$LNG.lm_officiers}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}
    <li>
      <a class="{if $page == 'trader'}menuActive{/if}" href="game.php?page=trader">{$LNG.lm_trader}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_FLEET_TRADER)}
    <li>
      <a class="{if $page == 'fleetDealer'}menuActive{/if}" href="game.php?page=fleetDealer">{$LNG.lm_fleettrader}</a>
    </li>
    {/if}

    {if isModuleAvailable($smarty.const.MODULE_ALLIANCE)}
    <li>
      <a class="" href="game.php?page=alliance">{$LNG.lm_alliance}</a>
    </li>
    {/if}
    {if $authlevel > 0}
    <li>
      <a class="" href="./admin.php" style="color:lime">{$LNG.lm_administration} ({$VERSION})</a>
    </li>
    {/if}
    {if $commit != ''}
    <li>
      <a href="https://github.com/ultimateXnova/ultimateXnova/commit/{$commit}"  class="" target="copy">ultimateXnova {$commitShort}</a>
    </li>
    {/if}
</ul>
</div>