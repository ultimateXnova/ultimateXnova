{block name="title" prepend}{$LNG.lm_battlesim}{/block}
{block name="content"}
<form id="form" name="battlesim">
	<input type="hidden" name="slots" id="slots" value="{$Slots + 1}">
	<table class="table table-gow table-sm fs-12 w-100">
		<tr>
			<th>{$LNG.lm_battlesim}</th>
		</tr>
		<tr>
			<td>
				<div class="d-flex align-items-center">
					<span class="py-2 text-center fw-bold color-blue">{$LNG.bs_steal}</span>
					<div class="d-flex flex-column align-items-center justify-content-center px-2">
						<label class="py-2 text-center" for="steal_metal">{$LNG.tech.901}:</label>
						<input id="steal_metal" class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text"  value="{if isset($battleinput.0.1.901)}{$battleinput.0.1.901}{else}0{/if}" name="battleinput[0][1][901]">
					</div>
					<div class="d-flex flex-column align-items-center justify-content-center px-2">
						<label class="py-2" for="steal_crystal">{$LNG.tech.902}:</label>
						<input id="steal_crystal" class="form-control fs-12 bg-dark text-white p-0 border border-secondary text-center" type="text"  value="{if isset($battleinput.0.1.902)}{$battleinput.0.1.902}{else}0{/if}" name="battleinput[0][1][902]">
					</div>
					<div class="d-flex flex-column align-items-center justify-content-center px-2">
						<label class="py-2" for="steal_deuterium">{$LNG.tech.903}:</label>
						<input id="steal_deuterium" class="form-control fs-12 bg-dark text-white p-0 border border-secondary text-center" type="text"  value="{if isset($battleinput.0.1.903)}{$battleinput.0.1.903}{else}0{/if}" name="battleinput[0][1][903]">
					</div>

				</div>

			</td>
		</tr>
		<tr>
			<td class="left">
				<input class="form-control fs-12 bg-blue text-white p-0 m-0 border border-secondary text-center" type="button" onClick="return add();" value="{$LNG.bs_add_acs_slot}">
			</td>
		</tr>
		<tr>
			<td class="transparent" style="padding:0;">
				<div id="tabs">
					<ul>
						{section name=tab start=0 loop=$Slots}<li><a href="#tabs-{$smarty.section.tab.index}">{$LNG.bs_acs_slot} {$smarty.section.tab.index + 1}</a></li>{/section}
					</ul>
					{section name=content start=0 loop=$Slots}
					<div id="tabs-{$smarty.section.content.index}">
						<table class="table table-gow table-sm fs-12">
							<tr>
								<th>{$LNG.bs_techno}</th>
								<th>{$LNG.bs_atter}</th>
								<th>{$LNG.bs_deffer}</th>
							</tr>
							<tr>
								<td></td>
								<td><button class="reset">{$LNG.bs_reset}</button></td>
								<td><button class="reset">{$LNG.bs_reset}</button></td>
							</tr>
							<tr>
								<td>{$LNG.tech.109}:</td>
								<td>
									<input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.109)}{$battleinput.{$smarty.section.content.index}.0.109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][109]"></td>
								<td>
									<input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.109)}{$battleinput.{$smarty.section.content.index}.1.109}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][109]"></td>
							</tr>
							<tr>
								<td>{$LNG.tech.110}:</td>
								<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.110)}{$battleinput.{$smarty.section.content.index}.0.110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][110]"></td>
								<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.110)}{$battleinput.{$smarty.section.content.index}.1.110}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][110]"></td>
							</tr>
							<tr>
								<td>{$LNG.tech.111}:</td>
								<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.111)}{$battleinput.{$smarty.section.content.index}.0.111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][111]"></td>
								<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.111)}{$battleinput.{$smarty.section.content.index}.1.111}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][111]"></td>
							</tr>
						</table>
						<br>
						<table class="table table-gow table-sm fs-12">
							<tr>
								<td class="transparent">
									<table>
										<tr>
											<th>{$LNG.bs_names}</th>
											<th>{$LNG.bs_atter}</th>
											<th>{$LNG.bs_deffer}</th>
										</tr>
										<tr>
											<td></td>
											<td><button class="reset">{$LNG.bs_reset}</button></td>
											<td><button class="reset">{$LNG.bs_reset}</button></td>
										</tr>
										{foreach $fleetList as $id}
										<tr>
											<td>{$LNG.tech.$id}:</td>
											<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.0.$id)}{$battleinput.{$smarty.section.content.index}.0.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][0][{$id}]"></td>
											<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.$id)}{$battleinput.{$smarty.section.content.index}.1.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][{$id}]"></td>
										</tr>
										{/foreach}
									</table>
								</td>
								{if $smarty.section.content.index == 0}
									<td style="width:50%" class="transparent">
										<table>
											<tr>
												<th>{$LNG.bs_names}</td>
												<th>{$LNG.bs_atter}</th>
												<th>{$LNG.bs_deffer}</th>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td><button class="reset">{$LNG.bs_reset}</button></td>
											</tr>
											{foreach $defensiveList as $id}
											<tr>
												<td>{$LNG.tech.$id}:</td>
												<td>-</td>
												<td><input class="form-control fs-12 bg-dark text-white p-0 m-0 border border-secondary text-center" type="text" size="10" value="{if isset($battleinput.{$smarty.section.content.index}.1.$id)}{$battleinput.{$smarty.section.content.index}.1.$id}{else}0{/if}" name="battleinput[{$smarty.section.content.index}][1][{$id}]"></td>
											</tr>
										{/foreach}
										</table>
									</td>
								{/if}
							</tr>
						</table>
					</div>
					{/section}
				</div>
			</td>
		</tr>
		<tr id="submit">
			<td><input type="button" onClick="return check();" value="{$LNG.bs_send}">&nbsp;<input type="reset" value="{$LNG.bs_cancel}"></td>
		</tr>
		<tr id="wait" style="display:none;">
			<td style="height:20px">{$LNG.bs_wait}</td>
		</tr>
	</table>
</form>
{/block}
