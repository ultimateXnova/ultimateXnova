{block name="title" prepend}{$LNG.lm_research}{/block}
{block name="content"}

<script>
  function showItem(id){

    if ($('#item_big_' + id).hasClass('d-none')) {
      $('.buildItemBig').addClass('d-none');
      $('.buildItemSmall').removeClass('border-color-active').removeClass('border-color-passive');
      $('#item_big_' + id).removeClass('d-none');
      $('#item_small_' + id).addClass('border-color-active');
    }else {
      $('#item_big_' + id).addClass('d-none');
      $('#item_small_' + id).addClass('border-color-passive').removeClass('border-color-active');
    }

  }

</script>

<script>
  $(document).ready(function(){
    $('.closeButton').hover(
      function(){
      $('.queueItemFirst').tooltip('hide');
    },
    function(){
      $(this).parent().parent().tooltip('show');
    }
  );
  });

  $(document).ready(function(){
    $('.button-upgrade-small').hover(
      function(){
      $(this).parent().parent().tooltip('hide');
    },
    function(){
      $(this).parent().parent().tooltip('show');
    }
  );
  });
</script>


{if $IsLabinBuild}
<div class="hidden-div">{$LNG.bd_building_lab}</div>
{/if}

<div class="ItemsWrapper">

<div style="background:url('{$dpath}images/research.webp');" class="itemShow d-flex justify-content-center align-items-center w-100 bg-black position-relative border-orange">

{foreach $ResearchList as $ID => $Element}
<div id="item_big_{$ID}" class="buildItemBig position-absolute top-0 left-0 d-flex flex-column d-none rounded border border-1 border-dark p-0 m-0 w-100">
  <div class="d-flex w-100 itemTop">
    <div class="d-flex align-items-start justify-content-center bg-black">
        <img class="mx-2 hover-pointer" onclick="return Dialog.info({$ID})" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="120" height="120">
    </div>
    <div class="d-flex flex-column w-100 bg-light-black">
      <div class="bg-blue d-flex justify-content-start mb-2 text-white fw-bold">
        <div class="d-flex px-2">
          <span class="fs-12 {if $Element.costOverflowTotal > 0}color-red hover-pointer{else}color-yellow{/if} p-0" {if $Element.costOverflowTotal > 0} data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="
            <table class='table fs-12'>
              <thead>
                <tr><th colspan='2' class='text-center'>{$LNG.bd_remaining}</th></tr>
              </thead>
              <tbody>
                {foreach $Element.costOverflow as $ResType => $ResCount}
                <tr>
                  <td>{$LNG.tech.$ResType}</td>
                  <td>{$ResCount|number}</td>
                </tr>
                {/foreach}
              </tbody>
            </table>"
            {/if}
            >
            {$LNG.tech.{$ID}}
          </span>
          <span class="fs-12 text-white" id="val_{$ID} p-0">
          &nbsp;({$LNG.bd_lvl}&nbsp;{$Element.level}{if $Element.maxLevel != 255}/{$Element.maxLevel}{/if})
          </span>
          {if !empty($Element.infoEnergyLong)}
          <span class="d-flex fs-12 p-0 hover-pointer {if {$Element.infoEnergyShort} > 0}color-green{else}color-red{/if}" data-bs-toggle="tooltip"
          data-bs-placement="left"
          data-bs-html="true"
          title = '<span class="fs-12">{$LNG.bd_next_level}&nbsp;{$Element.infoEnergyLong}</span>'>&nbsp;<i class="bi bi-activity"></i>&nbsp;{$Element.infoEnergyShort}</span>
          {/if}
        </div>

      </div>
      <div class="d-flex mx-2 justify-content-between">
        <div class="m-0 p-0">
          <span class="d-flex flex-column">
            {foreach $Element.costResources as $RessID => $RessAmount}
            <div class="d-flex align-items-center my-1">
              <img data-bs-toggle="tooltip"
              data-bs-placement="left"
              data-bs-html="true"
              title="{$LNG.tech.$RessID}" src='{$dpath}gebaeude/{$RessID}.{if $RessID >=600 && $RessID <= 699}jpg{else}gif{/if}'>
              <span class="mx-1 fs-11 {if $Element.costOverflow[$RessID] == 0}text-white{else}color-red{/if}">{$RessAmount|number}</span>
            </div>
            {/foreach}
              <span class="fs-10 my-1 text-white">{$LNG.fgf_time}&nbsp;:&nbsp;{pretty_time($Element.elementTime)}</span>
          </span>
        </div>
        <div class="d-flex flex-column justify-content-start align-items-end">
          {if $Element.maxLevel == $Element.levelToBuild}
            <span class="fs-12" style="color:#ffd600">{$LNG.bd_maxlevel} || <button>End Game</button></span>
          {elseif $IsLabinBuild || $IsFullQueue || !$Element.buyable}
          <span class="fs-12" style="color:#ffd600">
            <button data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-html="true" title="{$LNG.bd_build_next_level}
            {$Element.levelToBuild + 1}" class="button-upgrade-disabled" type="button" name="button">
              {$LNG.bd_build}
            </button>
          </span>
          {else}
              <form action="game.php?page=research" method="post" class="build_form">
                <input type="hidden" name="cmd" value="insert">
                <input type="hidden" name="tech" value="{$ID}">
                <button type="submit" class="button-upgrade" data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-html="true"
                title = "{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}">
                  {$LNG.bd_build}
                </button>
              </form>
            {/if}
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex w-100 bg-light-black itemInfo">
    <p class="text-white fs-11 p-2">{$LNG.shortDescription[$ID]}</p>
  </div>
</div>
{/foreach}
</div>

<div class="d-flex flex-wrap justify-content-start bg-black pb-2 border-orange">
  <div class="d-flex w-100 justify-content-start m-2">
    <span class="color-yellow fs-12 fw-bolt">{$LNG.lm_research}</span>
    <span class="color-yellow fs-12 fw-bolt">&nbsp;|&nbsp;{$LNG.st_points}&nbsp;[{$userTechPoints}]</span>
  </div>
  <div class="mx-2 d-flex flex-wrap">
          {foreach $ResearchList as $ID => $Element}
      <div class="buildItemSmall position-relative d-flex user-select-none" onclick="showItem({$ID})" id="item_small_{$ID}"
      data-bs-toggle="tooltip"
      data-bs-placement="top"
      data-bs-html="true"
      title="{$LNG.tech.{$ID}}
      {if !$Element.technologySatisfied && !empty($Element.requeriments)}
      <table class='table-tooltip'>
        <thead>
          <tr><th colspan='2' class='color-red'>{$LNG.tech_not_satisfied}</th></tr>
        </thead>
        <tbody>
          {foreach $Element.requeriments as $currentRequire}
          <tr>
            <td class='color-red'>
              <img class='mx-2 hover-pointer' src='{$dpath}gebaeude/{$currentRequire.requireID}.gif' alt='{$LNG.tech.{$currentRequire.requireID}}' width='30' height='30'>
            </td>
            <td class='color-red align-middle text-start'><span class='color-blue'>{$LNG.tech.{$currentRequire.requireID}}</span>&nbsp;({$currentRequire.neededLevel}&nbsp;/&nbsp;<span class='color-yellow'>{$currentRequire.currentLevel}</span>)</td>
          </tr>
          {/foreach}
        </tbody>
      </table>
      {/if}" >
      {if $IsLabinBuild || $IsFullQueue || !$Element.buyable || !$Element.technologySatisfied}
         <div class="black-screen d-flex position-absolute top-0 end-0 hover-pointer"></div>
      {/if}
      <div class="levelInfo d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 text-yellow bg-dark fs-11">{$Element.level}</div>
        <img class="hover-pointer" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="80" height="80">
        {if !$IsLabinBuild && !$IsFullQueue && $Element.buyable && $Element.technologySatisfied}
           <form action="game.php?page=research" method="post" class="position-absolute top-0 left-0">
             <input type="hidden" name="cmd" value="insert">
             <input type="hidden" name="tech" value="{$ID}">
             <button  type="submit" class="button-upgrade-small position-absolute top-0 left-0 d-flex" data-bs-toggle="tooltip"
             data-bs-placement="top"
             data-bs-html="true"
             title = "{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}">
             </button>
           </form>
        {/if}
      </div>
      {/foreach}
    </div>
</div>

</div>


  {if !empty($Queue)}
  <div id="buildlist" class="ItemsWrapper d-flex flex-wrap justify-content-start w-100 mx-auto my-2 py-2 bg-black border-orange">
  		{foreach $Queue as $List}
  		{$ID = $List.element}
      <div class="d-flex align-items-center {if $List@first}w-100{/if}">
        <div class="queueItemFirst position-relative d-flex flex-column" data-bs-toggle="tooltip"
        data-bs-placement="top"
        data-bs-html="true"
        title="{$LNG.tech.{$ID}}&nbsp;,&nbsp;<span data-time='{$List.endtime}' >{$List.display}</span>">
        <img class="m-0 hover-pointer" onclick="return Dialog.info({$ID})" src="{$dpath}gebaeude/{$ID}.gif" alt="{$LNG.tech.{$ID}}" width="80" height="80">
        <span class="position-absolute d-flex align-items-center justify-content-center top-0 start-0 levelInfo fs-11 bg-dark text-yellow py-1">{$List.level}</span>


        <form class="d-flex mx-auto align-items-center justify-content-center" action="game.php?page=research" method="post" >
          {if !$List@first}
          <input type="hidden" name="listid" value="{$List@iteration}">
          <input type="hidden" name="cmd" value="remove">
          {else}
          <input type="hidden" name="cmd" value="cancel">
          {/if}
          <button class="closeButton btn btn-dark d-flex position-absolute bottom-0 rounded end-0 p-0 bi bi-x-square color-red" type="submit" name="button"
            data-bs-toggle="tooltip"
            data-bs-placement="right"
            data-bs-html="true"
            title="{$LNG.bd_cancel}">
          </button>
        </form>
      </div>
        {if $List@first}
        <div class="d-flex flex-column align-items-start justify-content-start w-100 mx-2">
          <div style="border-radius:10px;height:12px;" id="progressbar" class="d-flex align-items-center my-2" data-time="{$List.resttime}"></div>
          <span class="fs-12 text-yellow">{$LNG['tech'][{$ID}]}&nbsp;:&nbsp;{$List.level}</span>
          <span class="text-center my-2 text-yellow fs-12" id="time" data-time="{$List.time}"></span>
          <span class="fs-12 text-yellow">{$List.display}</span>
        </div>
        {/if}
      </div>

  	{/foreach}
  </div>
  {/if}

{/block}
