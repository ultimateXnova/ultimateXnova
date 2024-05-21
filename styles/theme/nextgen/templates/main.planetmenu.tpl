{if $AllPlanets}
  <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m planets-container" uk-grid="">
  {foreach $AllPlanets as $PlanetRow}

      {if (isset($PlanetRow.moonInfo) && $PlanetRow.moonInfo[0].selected) || $PlanetRow.selected}
        <div class="uk-width-1-1 uk-margin-remove-top">
          
            <div class=" uk-padding-remove box-border box-shadow-large planet-box planet-active" style="background-image: url('{$dpath}planeten/{$PlanetRow.image}.jpg');">
            <a class="planet-url" href="game.php?page={$page}&amp;cp={$PlanetRow.id}">
            &nbsp; </a>  
           
              <div class="planet-info">
                <div class="planet-moons">
                  {if isset($PlanetRow.moonInfo)}
                    {foreach $PlanetRow.moonInfo as $MoonRow}
                      
                      <div class="planet-moon
                    {if $MoonRow.selected} planet-moon-active{/if}
                    ">
                    
                        <div class="planet-moon-details">
                        {$LNG.pm_fields}: {$MoonRow.field_current}&nbsp;/&nbsp;{$MoonRow.field_max}<br>
                        {$LNG.pm_diameter}: {$MoonRow.diameter}<br>
                        {$LNG.pm_min_temperature}: {$MoonRow.temp_min}<br>
                        {$LNG.pm_max_temperature}: {$MoonRow.temp_max}
                        </div>
                        <a class="planet-moons-url" href="game.php?page={$page}&amp;cp={$MoonRow.id}">
                          <img  src="{$dpath}planeten/{$MoonRow.image}_small.webp" alt="{$MoonRow.name}">
                        </a>
                      </div>
                    {/foreach}
                  {/if}
                </div>
                <div class="planet-details">
                    {$LNG.pm_fields}: {$PlanetRow.field_current}&nbsp;/&nbsp;{$PlanetRow.field_max}<br>
                    {$LNG.pm_diameter}: {$PlanetRow.diameter}<br>
                    {$LNG.pm_min_temperature}: {$PlanetRow.temp_min}<br>
                    {$LNG.pm_max_temperature}: {$PlanetRow.temp_max}
                    </div>
                <div class="planet-name">{$PlanetRow.name}</div>
                <div class="planet-coords">[{$PlanetRow.galaxy}:{$PlanetRow.system}:{$PlanetRow.planet}]</div>
              </div>
            </div>
          
      </div>
      {/if}
    
  {/foreach}
  {foreach $AllPlanets as $PlanetRow}

    {if !(isset($PlanetRow.moonInfo) && $PlanetRow.moonInfo[0].selected) && !$PlanetRow.selected}
      <div class="uk-width-1-2 uk-margin-remove-top">
      
        <div class=" uk-padding-remove box-border box-shadow-large planet-box planet-box-small planet-inactive" style="background-image: url('{$dpath}planeten/{$PlanetRow.image}.jpg');">
        <a class="planet-url" href="game.php?page={$page}&amp;cp={$PlanetRow.id}">
        &nbsp; </a>   
        <div class="planet-info">
        <div class="planet-moons">
        {if isset($PlanetRow.moonInfo)}
          {foreach $PlanetRow.moonInfo as $MoonRow}
            
            <div class="planet-moon">
              <a class="planet-moons-url" href="game.php?page={$page}&amp;cp={$MoonRow.id}">
                <img  src="{$dpath}planeten/{$MoonRow.image}_small.webp" alt="{$MoonRow.name}">
              </a>
            </div>
          {/foreach}
        {/if}
      </div>
            <div class="planet-name">{$PlanetRow.name}</div>
            <div class="planet-coords">[{$PlanetRow.galaxy}:{$PlanetRow.system}:{$PlanetRow.planet}]</div>
          </div>
        </div>
      
    </div>
    {/if}
  
{/foreach}
  </div>
{/if}
{if $hasMultiUniverseAccounts}
  {foreach $mu_unis as $universe_id => $universe_name}
    <div class="universes" uk-grid="">
      <a href="game.php?page=overview&switch_universe={$universe_id }" class="uk-button">Switch to {$universe_name}</a>
    </div>
  {/foreach}
{/if}