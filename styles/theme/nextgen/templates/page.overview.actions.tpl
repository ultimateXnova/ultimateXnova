{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="content"}

<script>
	function changeContent(type){

		if (type == 1) {
			$('#rename_planet').removeClass('d-none').addClass('d-flex');
			$('#abondon_planet').removeClass('d-flex').addClass('d-none');
		}else {
			$('#rename_planet').removeClass('d-flex').addClass('d-none');
			$('#abondon_planet').removeClass('d-none').addClass('d-flex');
		}

	}
</script>

<div class="d-flex flex-column">
	<div style="height:40px;" class="d-flex bg-dark text-white">
		<button class="btn btn-small button-blue text-white mx-1 my-1 fs-12 p-1" onclick="changeContent(1);">{$LNG.ov_planet_rename}</button>
		<button class="btn btn-small button-blue text-white mx-1 my-1 fs-12 p-1" onclick="changeContent(2);">{$LNG.ov_delete_planet}</button>
	</div>
	<div style="height:360px;" id="rename_planet" class="d-flex text-white fs-12">
		<form class="d-flex flex-column w-100 align-items-center h-100 justify-content-center">
			<div class="form-group my-1 d-flex justify-content-center">
				<input class="text-center form-control p-0 m-0 fs-12" placeholder="{$LNG.ov_rename_label}" type="text" name="name" id="name" size="25" maxlength="20" autocomplete="off">
			</div>
			<div class="form-group py-2 my-1 d-flex justify-content-center">
				<input class="mx-auto button-blue fs-12 px-2 py-2" type="button" onclick="checkrename();" value="{$LNG.ov_planet_rename}">
			</div>
		</form>
	</div>
	<div style="height:360px;" id="abondon_planet" class="d-none text-white fs-12">
		<form class="d-flex flex-column w-100 align-items-center h-100 justify-content-center">
			<div class="form-group d-flex justify-content-center align-items-center my-2">
				{$LNG.ov_security_request}
			</div>
			<div class="form-group d-flex justify-content-center align-items-center my-2">
				{$ov_security_confirm}
			</div>
			<div class="form-group d-flex justify-content-center align-items-center my-2">
				<input id="password" class="text-center form-control p-0 m-0 fs-12" type="password" name="password" placeholder="{$LNG.ov_ac_password}" autocomplete="new-password">
			</div>
			<div class="form-group d-flex justify-content-center align-items-center my-2">
				<input class="mx-auto button-blue fs-12 px-2 py-2" type="button" onclick="checkcancel()" value="{$LNG.ov_delete_planet}">
			</div>
		</form>
	</div>
</div>
{block name="script" append}
    <script src="scripts/game/overview.actions.js?v={$REV}"></script>
{/block}
{/block}
