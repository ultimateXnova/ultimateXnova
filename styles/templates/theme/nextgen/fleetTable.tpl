<div class="fleetWrapper d-flex flex-column">
  <div class="position-relative w-100 d-flex align-items-center">
    {if empty($fleets)}
      <span class="text-center color-blue fs-11 fw-bold w-100">{$LNG.fm_no_fleet_movements}</span>
    {else}
      <span class="fs-14 color-gray text-center">{$LNG.fm_fleets}</span>
    {/if}
    {if !empty($fleets)}
    <button style="height:18px;width:18px;" onclick="showHideFleets();" class="btn btn-sm d-flex align-items-center justify-content-center p-0 m-0 position-absolute hover-pointer end-0 top-0" type="button" name="button">
      <i style="color:#ddd;" class="bi bi-caret-down-square-fill"></i>
    </button>
    {/if}
  </div>

    {foreach $fleets as $index => $fleet}
    <div class="fs-11 fleetRow {if $show_fleets_active}d-none{/if}">
      <span id="fleettime_{$index}" class="fleets" data-fleet-end-time="{$fleet.returntime}" data-fleet-time="{$fleet.resttime}">
        {pretty_fly_time({$fleet.resttime})}
      </span>
      <span id="fleettime_{$index}">{$fleet.text}</span>
    </div>
    {/foreach}

</div>


<script>
  function showHideFleets(){

    $.ajax({
        type: "POST",
        url: 'game.php?page=fleetTableSettings&mode=changeVisibility&ajax=1',
        success: function(data)
        {

          if ($('.fleetRow').hasClass('d-none')) {
            $('.fleetRow').removeClass('d-none')
          }else {
            $('.fleetRow').addClass('d-none')
          }

        }

    });

  }
</script>
