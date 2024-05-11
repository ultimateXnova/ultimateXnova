{block name="content"}

<script type="text/javascript">
// this is the id of the form
function loginSubmit(activeRecaptcha,use_recaptcha_on_admin_login){
			var recaptchaResponse = false;

			if (activeRecaptcha == 1 && use_recaptcha_on_admin_login == 1) {
				recaptchaResponse = grecaptcha.getResponse();
			}

	    $.ajax({
	        type: "POST",
	        url: 'admin.php?page=login&mode=validate&ajax=1',
	        data: {
						password: $("#password").val(),
						g_recaptcha_response: recaptchaResponse,
					},
	        success: function(data)
	        {
						var dataParsed = jQuery.parseJSON(data);
						$('.alert').remove();

						if (dataParsed.status == 'fail') {
							if (activeRecaptcha == 1 && use_recaptcha_on_admin_login == 1) {
								grecaptcha.reset();
							}

							$.each( dataParsed, function( typeError, errorText ) {

								if (typeError == 'status') {
									return;
								}
								$('#loginButton').before("<span class='alert alert-danger fs-6 py-1 my-2'>"+ errorText +"</span>")

							});

		        }else if (dataParsed.status == 'redirect') {
							location.href = "admin.php?page=overview";
		        }

					}

	    });


}
</script>

	<form style="max-width:350px;margin-top:150px;" action="?page=login&mode=validate" method="post" class="mx-auto p-3 bg-black rounded">
	<img class="logo" src="styles/resource/images/ultimatexnova.svg" width="300px"/>
				
	<div class="form-group my-2 text-center fs-14 fw-bold text-white">
			{$LNG.adm_login}
		</div>
		<div class="form-group my-2 fs-12 fw-bold text-white">
			<label class="my-1 text-start fw-bold w-100" for="username">{$LNG.adm_username}:</label>
			<input id="username" class="form-control user-select-none" type="text" readonly value="{$username}">
		</div>
		<div class="form-group my-2 fs-12 fw-bold text-white">
			<label class="my-1 text-start fw-bold w-100" for="password">{$LNG.adm_password}:</label>
			<input id="password" class="form-control" type="password" name="admin_pw" autocomplete="new-password">
		</div>
		{if $recaptchaEnable && $use_recaptcha_on_admin_login}
			<div style="overflow:hidden;" class="g-recaptcha form-group w-100 fs-6 my-2 mx-auto d-flex justify-content-center" data-sitekey="{$recaptchaPublicKey}"></div>
		{/if}
		<div class="form-group my-2 fs-12 fw-bold text-white d-flex flex-column">
			<input id="loginButton" onclick="loginSubmit({$recaptchaEnable},{$use_recaptcha_on_admin_login});" class="btn btn-block w-100 btn-primary text-white" type="button" value="{$LNG.adm_absenden}">
		</div>
	</form>


	{if $recaptchaEnable && $use_recaptcha_on_admin_login}
		{block name="script" append}
			<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
		{/block}
	{/if}

{/block}
