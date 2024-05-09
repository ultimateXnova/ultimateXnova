
{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="content"}

<script>
  function showNews(){

    if ($('#newsRow').hasClass('d-none')) {
      $('#newsRow').removeClass('d-none');
    }else {
      $('#newsRow').addClass('d-none');
    }

  }
</script>


<div class="table-responsive">
  <table class="table table-sm fs-12 table-gow">
    <thead></thead>
    <tbody>
      <tr>
        <td class="text-start px-3 w-50">{$LNG["type_planet_{$planet_type}"]}</td>
        <td class="text-center px-3 w-50">
          <a href="#"  onclick="return Dialog.PlanetAction();" title="{$LNG.ov_planetmenu}">{$planetname}&nbsp;({$username})</a>
        </td>
      </tr>
      <tr>
        <td class="text-start px-3">{$LNG.ov_admins_online}</td>
        <td class="text-center px-3 w-50">
          {foreach $AdminsOnline as $ID => $Name}
          {if !$Name@first}&nbsp;&bull;&nbsp;{/if}
          <a href="#" onclick="return Dialog.PM({$ID})"><a style="color:lime">{$Name}</a>
          {foreachelse}
          {/foreach}
        </td>
      </tr>
      <tr>
        <td class="text-start px-3">{$LNG.ov_players}</td>
        <td class="text-center px-3 w-50"><a style="color:lime">{$usersOnline}</a></td>
      </tr>
      <tr>
        <td class="text-start px-3">{$LNG.ov_moving_fleets}</td>
        <td class="text-center px-3 w-50"><a style="color:lime">{$fleetsOnline}</a></td>
      </tr>
      <tr>
        <td class="text-start px-3">{$LNG.ov_points}</td>
        <td class="text-center px-3 w-50">{$rankInfo}</td>
      </tr>
    {if !empty($news)}
      <tr>
        <td class="text-center" colspan="3">
          <button class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow" onclick="showNews();">Check News</button>
        </td>
      </tr>
      <tr id="newsRow" class="d-none">
        <td colspan="2">
          <table class="table table-gow fs-12">
            <thead>
              <tr>
                <th class="color-blue text-center" colspan="3">{$LNG.ov_news}</th>
              </tr>
            </thead>
            <tbody>
              {foreach $news as $currentNews}
              <tr>
                <td class="text-center color-blue">{$currentNews.user}</td>
                <td class="text-center color-blue">{$currentNews.date}</td>
                <td class="text-center color-blue">{$currentNews.text}</td>
              </tr>
              {/foreach}
            </tbody>
          </table>
        </td>

      </tr>
    {/if}
    <tr>
      <td>
        <div class="d-flex flex-row align-items-center justify-content-center  fs-12">
          <div class="d-flex flex-column align-items-center justify-content-center w-100">
            <span>{$planetname}</span>
            <a class="hover-pointer" href="?page=overview&cp={$planet_id}">
              <img src="{$dpath}planeten/{$planetimage}.jpg" height="160" width="160" alt="{$planetname}">
            </a>
          </div>
          {if $Moon}
          <div class="d-flex flex-column align-items-center justify-content-center w-100">
            <a href="game.php?page=overview&amp;cp={$Moon.id}" title="{$Moon.name}">
              <img src="{$dpath}planeten/{$Moon.image}.jpg" height="50" width="50" alt="{$Moon.name} {if $Moon.planet_type == 3}({$LNG.fcm_moon}){/if}">
            </a>
            <span>{$Moon.name} {if $Moon.planet_type == 3}({$LNG.fcm_moon}){/if}</span>
          </div>
          {/if}
        </div>
      </td>
      <td>
        <table class="table table-gow table-sm my-2">
          <thead></thead>
          <tbody class="fs-12">
            <tr>
              <td ><span style="color:skyblue">{$LNG.ov_diameter}:</span> </td>
              <td class="text-center">{$LNG.ov_distance_unit} (<a title="{$LNG.ov_developed_fields}">{$planet_field_current}</a> / <a title="{$LNG.ov_max_developed_fields}">{$planet_field_max}</a> {$LNG.ov_fields})</td>
            </tr>
            <tr>
              <td ><span style="color:skyblue">{$LNG.ov_temperature}:</span></td>
              <td class="text-center">{$LNG.ov_aprox} {$planet_temp_min}{$LNG.ov_temp_unit} {$LNG.ov_to} {$planet_temp_max}{$LNG.ov_temp_unit}</td>
            </tr>
            <tr>
              <td><span style="color:skyblue">{$LNG.ov_position}:</span></td>
              <td class="text-center">
                <a class="hover-underline" href="game.php?page=galaxy&amp;galaxy={$galaxy}&amp;system={$system}">[{$galaxy}:{$system}:{$planet}]</a>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
  </table>
</div>


<table class="table table-sm table-gow my-2">
  <tr>
    <td class="text-center">
      {if $buildInfo.buildings}
      <a href="game.php?page=buildings">{$LNG.lm_buildings}: </a>
      {$LNG.tech[$buildInfo.buildings['id']]} ({$buildInfo.buildings['level']})<br>
      <div class="timer" data-time="{$buildInfo.buildings['timeleft']}">{$buildInfo.buildings['starttime']}</div>
      {else}
      <a class="hover-underline" href="game.php?page=buildings">{$LNG.lm_buildings}: {$LNG.ov_free}</a><br>
      {/if}
    </td>
    <td class="text-center">
      {if $buildInfo.tech}
      <a href="game.php?page=research">{$LNG.lm_research}: </a>
      {$LNG.tech[$buildInfo.tech['id']]} ({$buildInfo.tech['level']})<br>
      <div class="timer" data-time="{$buildInfo.tech['timeleft']}">{$buildInfo.tech['starttime']}</div>
      {else}
      <a class="hover-underline" href="game.php?page=research">{$LNG.lm_research}: {$LNG.ov_free}</a>
      {/if}
    </td>
    <td class="text-center">
      {if $buildInfo.fleet}
      <a href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}: </a>
      {$LNG.tech[$buildInfo.fleet['id']]} ({$buildInfo.fleet['level']})<br>
      <div class="timer" data-time="{$buildInfo.fleet['timeleft']}">{$buildInfo.fleet['starttime']}</div>
      {else}
      <a class="hover-underline" href="game.php?page=shipyard&amp;mode=fleet">{$LNG.lm_shipshard}: {$LNG.ov_free}</a>
      {/if}
    </td>
  </tr>
</table>





{/block}
