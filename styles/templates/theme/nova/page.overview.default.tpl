
{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="content"}

<script>
  function showNews(){

    $.ajax({
        type: "POST",
        url: 'game.php?page=overview&mode=changeNewsVisibility&ajax=1',
        success: function(data)
        {

          if ($('#newsRow').hasClass('d-none')) {
            $('#newsRow').removeClass('d-none')
          }else {
            $('#newsRow').addClass('d-none')
          }

        }

    });

  }
</script>


<style>
	.hidden-div {
    display:none;
  }
</style>

<div class="d-flex flex-column">
	{if $messages}
	 <div class="message">
     <a href="?page=messages">{$messages}</a>
   </div>
	{/if}
<div class="bg-purple p-2 d-flex justify-content-center">
  <a class="fs-14" href="#" onclick="return Dialog.PlanetAction();" title="{$LNG.ov_planetmenu}">[{$LNG["type_planet_{$planet_type}"]}:&nbsp;{$planetname}]&nbsp;-&nbsp;</a>
  <span class="fs-14">[{$username}]</span>
</div>
  <table class="bg-nova">
    <tr>
      <td><span class="fs-12">{$LNG.ov_server_time}:</span></td>
      <td><span class="servertime fs-12">{$servertime}</span></td>
    </tr>
    <tr>
      <td><span>{$LNG.ov_admins_online}:&nbsp;</span></td>
      <td>
        {foreach $AdminsOnline as $ID => $Name}
          {if !$Name@first}
            &nbsp;&bull;&nbsp;
          {/if}
        <a href="#" onclick="return Dialog.PM({$ID})">
          <a style="color:lime">{$Name}</a>
        </a>
        {foreachelse}
        {/foreach}
      </td>
    </tr>
    <tr>
      <td><span class="fs-12">{$LNG.ov_online}:&nbsp;</span></td>
      <td><a class="fs-12" style="color:lime">{$usersOnline}</a></td>
    </tr>
    <tr>
      <td><span class="fs-12">{$LNG.ov_moving_fleets}:&nbsp;</span></td>
      <td><a style="color:lime">{$fleetsOnline}</a></td>
    </tr>
    <tr>
      <td>{$LNG.ov_points}:</td>
      <td>{$rankInfo}</td>
    </tr>
  </table>
{if !empty($news)}
<div class="d-flex justify-content-center bg-purple mt-2">
  <button class="text-yellow" onclick="showNews();">Check News</button>
</div>
<div class="bg-nova">
  <table id="newsRow" class="{if $show_news_active}d-none{/if}">
      <tr class="bg-purple">
        <th colspan="3">{$LNG.ov_news}</th>
      </tr>
      {foreach $news as $currentNews}
      <tr>
        <td class="text-center color-blue">{$currentNews.user}</td>
        <td class="text-center color-blue">{$currentNews.date}</td>
        <td class="text-center color-blue">{$currentNews.text}</td>
      </tr>
      {/foreach}
  </table>
</div>

{/if}

<div class="d-flex bg-nova px-2 justify-content-center">
{if $Moon}
<div class="d-flex flex-column align-items-center justify-content-center p-1">
  <a href="game.php?page=overview&amp;cp={$Moon.id}" title="{$Moon.name}">
    <img src="{$dpath}planeten/{$Moon.image}.jpg" height="100" width="100" style="margin: 20% 0px 5px 0px;" alt="{$Moon.name} {if $Moon.planet_type == 3}({$LNG.fcm_moon}){/if}">
  </a>
  <span>{$Moon.name} {if $Moon.planet_type == 3}({$LNG.fcm_moon}){/if}</span>
</div>
{/if}
<div class="d-flex py-2">
  <a class="hover-pointer" href="?page=overview&cp={$planet_id}">
    <img src="{$dpath}planeten/{$planetimage}.jpg" height="175" width="175" alt="{$planetname}">
  </a>
  <div class="d-flex flex-column px-2">
      <table>
        <tr>
          <td><span class="fs-12 fw-bold text-center">{$planetname}</span></td>
        </tr>
        <tr>
          <td>
            {if $buildInfo.buildings}
            <a class="fs-12 fw-bold" href="game.php?page=buildings">{$LNG.lm_buildings}: {$LNG.tech[$buildInfo.buildings['id']]} ({$buildInfo.buildings['level']})</a>
            <div class="timer" data-time="{$buildInfo.buildings['timeleft']}">
              {$buildInfo.buildings['starttime']}
            </div>
            {else}
            <a class="fs-12 fw-bold" href="game.php?page=buildings">{$LNG.lm_buildings}: {$LNG.ov_free}</a>
            {/if}
          </td>
        </tr>
        <tr>
          <td>
            {if $buildInfo.tech}
            <a class="fs-12 fw-bold" href="game.php?page=research">{$LNG.lm_research}:       {$LNG.tech[$buildInfo.tech['id']]} ({$buildInfo.tech['level']})</a>
            <div class="timer" data-time="{$buildInfo.tech['timeleft']}">
              {$buildInfo.tech['starttime']}
            </div>
            {else}
            <a class="fs-12 fw-bold" href="game.php?page=research">{$LNG.lm_research}: {$LNG.ov_free}</a>
            {/if}
          </td>
        </tr>
        <tr>
          <td>
            {if $buildInfo.fleet}
            <a class="fs-12 fw-bold" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}: {$LNG.tech[$buildInfo.fleet['id']]} ({$buildInfo.fleet['level']})</a>
            <div class="timer" data-time="{$buildInfo.fleet['timeleft']}">
              {$buildInfo.fleet['starttime']}
            </div>
            {else}
            <a class="fs-12 fw-bold" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}: {$LNG.ov_free}</a>
            {/if}

          </td>
        </tr>
        <tr>
          <td>
            <span class="fs-12 fw-bold">{$LNG.ov_diameter}: {$LNG.ov_distance_unit}(<a title="{$LNG.ov_developed_fields}">{$planet_field_current}</a> / <a title="{$LNG.ov_max_developed_fields}">{$planet_field_max}</a> {$LNG.ov_fields})</span>
          </td>
        </tr>
        <tr>
          <td>
            <span class="fs-12 fw-bold">{$LNG.ov_temperature}: {$LNG.ov_aprox} {$planet_temp_min}{$LNG.ov_temp_unit} {$LNG.ov_to} {$planet_temp_max}{$LNG.ov_temp_unit}</span>
          </td>
        </tr>
        <tr>
          <td>
            <span class="fs-12 fw-bold">{$LNG.ov_position}: <a href="game.php?page=galaxy&amp;galaxy={$galaxy}&amp;system={$system}">[{$galaxy}:{$system}:{$planet}]</a></span>
          </td>
        </tr>
        {if  isModuleAvailable($smarty.const.MODULE_RELOCATE)}
        <tr >
          <td colspan="2" class="text-center">
            <a class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow" href="game.php?page=relocate">{$LNG.rl_relocate}</a>
          </td>
        </tr>
        {/if}
      </table>
    </div>
</div>
&nbsp;</br>
</div>
<br>
<div class="d-flex flex-column bg-nova">
{if $AllPlanets}
<span class="d-flex bg-purple text-white fs-12 justify-content-center align-items-center p-2">{$LNG.lv_planet}</span>
<div class="d-flex justify-content-center flex-wrap">
      {foreach $AllPlanets as $PlanetRow}
      <div style="width:140px;height:140px;margin:0 5px;" class="d-flex justify-content-start align-items-center">
        <a class="d-flex flex-column justify-content-center align-items-center hover-pointer text-decoration-none" href="game.php?page={$page}&amp;cp={$PlanetRow.id}" data-bs-toggle="tooltip"
        data-bs-placement="left"
        data-bs-html="true"
        title="
        <table class='table-tooltip fs-11'>
          <thead>
            <tr>
              <th class='text-start color-yellow' colspan='2'>{$PlanetRow.name}&nbsp;[{$PlanetRow.galaxy}:{$PlanetRow.system}:{$PlanetRow.planet}]</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class='text-start color-blue fw-bold'>{$LNG.pm_fields}:</td>
              <td class='text-end'>({$PlanetRow.field_current}&nbsp;/&nbsp;{$PlanetRow.field_max})</td>
            </tr>
            <tr>
              <td class='text-start color-blue fw-bold'>{$LNG.pm_diameter}:</td>
              <td class='text-end'>{$PlanetRow.diameter}</td>
            </tr>
            <tr>
              <td class='text-start color-blue fw-bold'>{$LNG.pm_min_temperature}:</td>
              <td class='text-end'>{$PlanetRow.temp_min}</td>
            </tr>
            <tr>
              <td class='text-start color-blue fw-bold'>{$LNG.pm_max_temperature}:</td>
              <td class='text-end'>{$PlanetRow.temp_max}</td>
            </tr>
          </tbody>
        </table>
        ">
        {if !empty($PlanetRow)}
          <img class="mx-2
          {if $PlanetRow.selected}
          border-yellow
          {else}
          hover-border-yellow
          {/if}
          " src="{$dpath}planeten/{$PlanetRow.image}.jpg" width="100" height="100" alt="{$PlanetRow.name}">
        <div class="d-flex flex-column text-yellow align-items-start justify-content-start fs-11">
          <span>{$PlanetRow.name}</span>
          <span>[{$PlanetRow.galaxy}:{$PlanetRow.system}:{$PlanetRow.planet}]</span>
        </div>
        {/if}
      </a>
      {if isset($PlanetRow.moonInfo)}
      <a style="margin-bottom:15px;" class="hover-pointer" href="game.php?page={$page}&amp;cp={$PlanetRow.moonInfo[0].id}"
      data-bs-toggle="tooltip"
      data-bs-placement="left"
      data-bs-html="true"
      title="
      <table class='table-tooltip fs-11'>
        <thead>
          <tr>
            <th class='text-start color-yellow' colspan='2'>{$PlanetRow.moonInfo[0].name}&nbsp;[{$PlanetRow.moonInfo[0].galaxy}:{$PlanetRow.moonInfo[0].system}:{$PlanetRow.moonInfo[0].planet}]</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class='text-start color-blue fw-bold'>{$LNG.pm_fields}:</td>
            <td class='text-end'>({$PlanetRow.moonInfo[0].field_current}&nbsp;/&nbsp;{$PlanetRow.moonInfo[0].field_max})</td>
          </tr>
          <tr>
            <td class='text-start color-blue fw-bold'>{$LNG.pm_diameter}:</td>
            <td class='text-end'>{$PlanetRow.moonInfo[0].diameter}</td>
          </tr>
          <tr>
            <td class='text-start color-blue fw-bold'>{$LNG.pm_min_temperature}:</td>
            <td class='text-end'>{$PlanetRow.moonInfo[0].temp_min}</td>
          </tr>
          <tr>
            <td class='text-start color-blue fw-bold'>{$LNG.pm_max_temperature}:</td>
            <td class='text-end'>{$PlanetRow.moonInfo[0].temp_max}</td>
          </tr>
        </tbody>
      </table>
      ">
        <img class="mx-2 {if $PlanetRow.moonInfo[0].selected}border-yellow{else}hover-border-yellow{/if}" src="{$dpath}planeten/{$PlanetRow.moonInfo[0].image}.jpg" width="25" height="25" alt="{$PlanetRow.moonInfo[0].name}">
      </a>
      {/if}
      </div>
{/foreach}
</div>

</div>
{/if}

</div>



</div>

{/block}
{block name="script" append}
    <script src="scripts/game/overview.js"></script>
{/block}
