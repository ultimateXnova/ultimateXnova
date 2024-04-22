{block name="title" prepend}{$LNG.lm_fleet}{/block}
{block name="content"}
<form action="game.php?page=fleetStep3" method="post">
<input type="hidden" name="token" value="{$token}">
   	<table class="table table-gow table-sm fs-12">
        <tr>
        	<th colspan="2">[{$galaxy}:{$system}:{$planet}] - {$LNG["type_planet_{$type}"]}</th>
        </tr>
		<tr>
			<td class="text-center">{$LNG.fl_mission}</td>
      <td class="text-center">{$LNG.fl_resources}</td>
    </tr>
		<tr>
			<td class="w-50" {if $StaySelector} rowspan="5"{/if}>
    		<table class="table table-gow table-sm" border="0" cellpadding="0" cellspacing="0" style="margin:5px 0;padding:0;">
    			{foreach $MissionSelector as $MissionID}
					<tr>
						<td>
						<input id="radio_{$MissionID}" type="radio" name="mission" value="{$MissionID}" {if $mission == $MissionID || $MissionID@total == 1}checked="checked"{/if} style="width:60px;">
            <label for="radio_{$MissionID}">{$LNG["type_mission_{$MissionID}"]}</label>
							{if $MissionID == 17}
              <div class="fs-11 color-red px-2">{$LNG.fl_transfer_alert_message}</div>
              {/if}
							{if $MissionID == 15}
              <div class="fs-11 color-red px-2">{$LNG.fl_expedition_alert_message}</div>
              {/if}
							{if $MissionID == 11}
              <div class="fs-11 color-red px-2">{$fl_dm_alert_message}</div>
              {/if}
						</td>
					</tr>
			   {/foreach}
    		</table>
      </td>
      <td class="w-50">
				<table class="table table-gow table-sm fs-12" border="0" cellpadding="0" cellspacing="0" style="margin:5px 0;padding:0;">
              <tr colspan="5">
        				<td style="vertical-align: middle;" colspan="1">{$LNG.tech.901}</td>
        				<td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="maxResource('metal');">{$LNG.fl_max}</button>
                </td>
                <td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="minResource('metal');">min</button>
                </td>
        				<td colspan="2">
                  <input id="metal_to_transport" style="height:24px;" class="form-control bg-black text-white" name="metal" onchange="calculateTransportCapacity();" type="text">
                </td>
        			</tr>
              <tr>
        				<td style="vertical-align: middle;" colspan="1">{$LNG.tech.902}</td>
        				<td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="maxResource('crystal');">{$LNG.fl_max}</button>
                </td>
                <td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="minResource('crystal');">min</button>
                </td>
        				<td colspan="2">
                  <input id="crystal_to_transport" style="height:24px;" class="form-control bg-black text-white" name="crystal" onchange="calculateTransportCapacity();" type="text">
                </td>
        			</tr>
              <tr>
        				<td style="vertical-align: middle;" colspan="1">{$LNG.tech.903}</td>
        				<td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="maxResource('deuterium');">{$LNG.fl_max}</button>
                </td>
                <td colspan="1">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11" onclick="minResource('deuterium');">min</button>
                </td>
        				<td colspan="2">
                  <input id="deuterium_to_transport" style="height:24px;" class="form-control bg-black text-white" name="deuterium" onchange="calculateTransportCapacity();" type="text">
                </td>
        			</tr>
              <tr>
        				<td colspan="1">{$LNG.fl_resources_left}</td>
        				<td style="vertical-align: middle;" colspan="4">
                  <input id="remainingresources" style="height:24px;" class="form-control bg-black text-white" readonly>
                </td>
        			</tr>
              <tr>
        				<td colspan="5" class="text-center">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11 w-50" onclick="maxResources();">{$LNG.fl_all_resources}</button>
                </td>
        			</tr>
              <tr>
        				<td colspan="5" class="text-center">
                  <button type="button" style="padding:2px;" class="btn btn-sm p-1 bg-dark text-white fs-11 w-50" onclick="minResources();">reset</button>
                </td>
        			</tr>
              <tr>
        				<td colspan="5" class="text-center color-red">{$LNG.fl_fuel_consumption}: <span id="consumption" class="consumption">{$consumption}</span></td>
        			</tr>
				</table>
			</td>
		</tr>
		{if $Exchange}
		<tr style="height:20px;">
			<th>{$LNG.fl_exchange}</th>
		</tr>
		<tr style="height:20px;">
			<td>
				<table class="table table-gow table-sm">
				<tr class="no-border">
					<td >
						<select name="resEx">
							<option value="1">{$LNG.tech.901}</option>
							<option value="2">{$LNG.tech.902}</option>
							<option value="3">{$LNG.tech.903}</option>
						</select>
					</td>
					<td>
						<input name="exchange" size="10" type="text">
					</td>
				</tr>
				<tr class="no-border">
					<td>
						{$LNG.fl_visibility}
					</td>
					<td>
						<select name="visibility">
							<option value="2" selected>{$LNG.fl_visibility_no_enemies}</option>
							<option value="1">{$LNG.fl_visibility_alliance}</option>
							<option value="0">{$LNG.fl_visibility_all}</option>
						</select>
					</td>
				</tr>
				<tr class="no-border">
					<td>
						{$LNG.fl_market_type}
					</td>
					<td>
						<select name="markettype">
							<option value="0" selected>{$LNG.fl_mt_resources}</option>
							<option value="1">{$LNG.fl_mt_fleet}</option>
						</select>
					</td>
				</tr>
			</table>
			<!--
			Max flight time (0 = unlimited):
			<input name="maxFlightTime" size="10" type="text" value="0"> hours<br/>
			-->
			</td>
		</tr>
		{/if}

		{if $StaySelector}
		<tr style="height:20px;">
			<th class="text-center">{$LNG.fl_hold_time}</th>
		</tr>
		<tr style="height:20px;">
			<td>
			{html_options name=staytime options=$StaySelector} {$LNG.fl_hours}
			</td>
		</tr>
		{/if}
        <tr style="height:20px;">
        	<td colspan="2"><input class="button-upgrade" value="{$LNG.fl_continue}" type="submit" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
data	= {$fleetdata|json};
</script>
{/block}
