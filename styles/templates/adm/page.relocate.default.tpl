{block name="content"}

<form id="colonySettings" class="bg-black w-75 text-white p-3 my-3 mx-auto fs-12" action="?page=relocate&mode=saveSettings" method="post">
  <div class="form-gorup d-flex flex-column my-1 p-2 ">
  	<label class="text-start my-1 cursor-pointer hover-underline" for="relocate_price">Relocate Price (DM)</label>
  	<input id="relocate_price" class="form-control py-1 bg-dark text-white my-1 border border-secondary" name="relocate_price" value="{$relocate_price}" type="text" maxlength="5">
  </div>
  <div class="form-gorup d-flex flex-column my-1 p-2 ">
    <label class="text-start my-1 cursor-pointer hover-underline" for="relocate_next_time">Relocate Next time (Hours)</label>
    <input id="relocate_next_time" class="form-control py-1 bg-dark text-white my-1 border border-secondary" name="relocate_next_time" value="{$relocate_next_time}" type="text" maxlength="5">
  </div>
  <div class="form-gorup d-flex flex-column my-1 p-2 ">
    <label class="text-start my-1 cursor-pointer hover-underline" for="relocate_jump_gate_active">Jump Gate Cooldown after relocate (Hours)</label>
    <input id="relocate_jump_gate_active" class="form-control py-1 bg-dark text-white my-1 border border-secondary" name="relocate_jump_gate_active" value="{$relocate_jump_gate_active}" type="text" maxlength="5">
  </div>
  <div class="form-gorup d-flex flex-column my-1 p-2 ">
  	<label class="text-start my-1 cursor-pointer hover-underline" for="relocate_move_fleet_directly" >relocate_move_fleet_directly</label>
  	<input id="relocate_move_fleet_directly" type="checkbox" {if $relocate_move_fleet_directly}checked="checked"{/if} name="relocate_move_fleet_directly">
  </div>

  <div class="form-gorup d-flex flex-column my-1 p-2 ">
  	<input  class="btn btn-primary text-white" value="{$LNG.se_save_parameters}" type="submit">
  </div>
</form>
{/block}
