
{block name="title" prepend}
{$LNG.lm_technology}{/block}

{block name="content"}



<script>
  function toggleTechDiv(id){
    console.log($('#h' + id).hasClass('flex-column'));
    if($('.h' + id).hasClass('d-none')){
      $('.h' + id).addClass('d-flex').removeClass('d-none');
      $('#button_icon_' + id ).removeClass('bi-plus-circle').addClass('bi-dash-circle');
    }else {
      $('.h' + id).addClass('d-none').removeClass('d-flex');
      $('#button_icon_' + id).removeClass('bi-dash-circle').addClass('bi-plus-circle');
    }
    console.log(id);
  }
</script>


<div class="techWrapper">

{foreach $TechTreeList as $elementID => $requireList}

{if !is_array($requireList)}
<div class="techb mt-1 mx-2 d-flex align-items-center" id="{$requireList}">
	<button style="width:20px;height:20px;" class="btn btn-dark px-2 py-0 text-white d-flex align-items-center justify-content-center" onclick="toggleTechDiv(id = {$elementID});">
		<i id="button_icon_{$requireList}" class="bi bi-plus-circle"></i>
	</button>
	<span class="fs-12 text-white px-2 my-2">{$LNG.tech.$requireList}</span>
</div>
{else}
	{if $requireList}
	<div class="d-none flex-column align-items-center fs-12 px-2 my-2 mx-auto {if ($elementID < 100)}h0{elseif ($elementID < 200)}h100{elseif ($elementID < 300)}h200{elseif ($elementID < 500)}h400{elseif ($elementID < 600)}h500{elseif ($elementID < 700)}h600{/if}">
	<span>
		<a class="text-decoration-none color-yellow" href="#" onclick="return Dialog.info({$elementID})">{$LNG.tech.$elementID}</a>
	</span>
	<a href="#" onclick="return Dialog.info({$elementID})">
		<img src="{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}" width="89" height="89">
	</a>
	<span>{$LNG.tt_requirements}:</span>
		{foreach $requireList as $requireID => $NeedLevel}
			<a class="text-decoration-none" href="#" onclick="return Dialog.info({$requireID})">
				<span class="{if $NeedLevel.own < $NeedLevel.count}color-yellow{else}color-green{/if}">{$LNG.tech.$requireID} ({$LNG.tt_lvl} {$NeedLevel.own}/{$NeedLevel.count})</span>
			</a>
			{if !$NeedLevel@last}
			{/if}
		{/foreach}
	</div>
	{/if}
{/if}
{/foreach}
</div>

{/block}
