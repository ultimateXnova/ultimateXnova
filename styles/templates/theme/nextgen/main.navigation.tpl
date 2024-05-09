<ul class="list-unstyled d-flex flex-column align-items-center w-100 m-0 p-0" id="menu">
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'overview'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=overview">{$LNG.lm_overview}</a>
    </li>
    {if isModuleAvailable($smarty.const.MODULE_BUILDING)}
    <li class="d-flex w-50  menu-button">
      <a class="{if $page == 'buildings'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none"  href="game.php?page=buildings">{$LNG.lm_buildings}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_FLEET)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'shipyard' && $mode == 'fleet'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_SHIPYARD_DEFENSIVE)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'shipyard' && $mode == 'defense'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=shipyard&amp;mode=defense">{$LNG.lm_defenses}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_RESEARCH)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'research'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=research">{$LNG.lm_research}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'fleetTable'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=fleetTable">{$LNG.lm_fleet}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_GALAXY)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'galaxy'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=galaxy">{$LNG.lm_galaxy}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_IMPERIUM)}
    <li class="d-flex w-50 menu-button">
      <a target="_blank" class="{if $page == 'imperium'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=imperium">{$LNG.lm_empire}</a>
    </li>
    {/if}

    {if isModuleAvailable($smarty.const.MODULE_TECHTREE)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'techtree'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=techtree">{$LNG.lm_technology}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_RESSOURCE_LIST)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'resources'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=resources">{$LNG.lm_resources}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_OFFICIER) || isModuleAvailable($smarty.const.MODULE_DMEXTRAS)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'officier'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=officier">{$LNG.lm_officiers}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_TRADER)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'trader'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=trader">{$LNG.lm_trader}</a>
    </li>
    {/if}
    {if isModuleAvailable($smarty.const.MODULE_FLEET_TRADER)}
    <li class="d-flex w-50 menu-button">
      <a class="{if $page == 'fleetDealer'}menuActive{/if} w-100 d-flex align-items-center justify-content-center p-0 fs-12 fw-bold text-decoration-none" href="game.php?page=fleetDealer">{$LNG.lm_fleettrader}</a>
    </li>
    {/if}

    {if isModuleAvailable($smarty.const.MODULE_ALLIANCE)}
    <li class="d-flex w-50 menu-button">
      <a class="w-100 d-flex align-items-center fs-12 fw-bold justify-content-center p-0 text-decoration-none" href="game.php?page=alliance">{$LNG.lm_alliance}</a>
    </li>
    {/if}
    {if $authlevel > 0}
    <li  class="d-flex w-50  menu-button">
      <a class="w-100 d-flex align-items-center fs-10 fw-bold justify-content-center p-0 text-decoration-none" href="./admin.php" style="color:lime">{$LNG.lm_administration} ({$VERSION})</a>
    </li>
    {/if}
    {if $commit != ''}
    <li class="d-flex w-50  menu-button">
      <a href="https://github.com/ultimateXnova/ultimateXnova/commit/{$commit}"  class="w-100 d-flex align-items-center fs-10 fw-bold justify-content-center p-0 text-decoration-none" target="copy">ultimateXnova {$commitShort}</a>
    </li>
    {/if}
</ul>
