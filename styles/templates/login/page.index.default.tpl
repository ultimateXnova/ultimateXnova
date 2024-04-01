{block name="title" prepend}{$LNG.siteTitleIndex}{/block}
{block name="content"}

<script type="text/javascript">
// this is the id of the form
function loginSubmit(activeRecaptcha,use_recaptcha_on_login){
			var recaptchaResponse = false;


			if (activeRecaptcha == 1 && use_recaptcha_on_login == 1) {
				recaptchaResponse = grecaptcha.getResponse();
			}

	    $.ajax({
	        type: "POST",
	        url: 'index.php?page=login&mode=validate&ajax=1',
	        data: {
						userEmail: $("#userEmail").val(),
						password: $("#password").val(),
						g_recaptcha_response: recaptchaResponse,
						csrfToken: $('#csrfToken').val(),
						remember_me : $('#remember_me').is(':checked'),
						universe : $('#universe option:selected').val(),
						rememberedTokenValidator : $('#rememberedTokenValidator').val(),
						rememberedTokenSelector : $('#rememberedTokenSelector').val(),
						rememberedEmail : $('#rememberedEmail').val(),
					},
	        success: function(data)
	        {
						var dataParsed = jQuery.parseJSON(data);
						$('.alert').remove();

						if (dataParsed.status == 'fail') {
							if (activeRecaptcha == 1 && use_recaptcha_on_login == 1) {
								grecaptcha.reset();
							}

							$.each( dataParsed, function( typeError, errorText ) {

								if (typeError == 'status') {
									return;
								}
								$('#loginButton').before("<span class='alert alert-danger fs-6 py-1 my-1'>"+ errorText +"</span>")

							});

		        }else if (dataParsed.status == 'redirect') {
							location.href = "game.php";
		        }

					}

	    });


}




</script>

	<img class="img-fluid px-1" src="styles/resource/images/ultimatexnova.svg" width="400px"/><h1 class="fs-3 my-4 w-100">{sprintf($LNG.loginWelcome, $gameName)}</h1>
	<p style="max-width:600px;" class="fs-6 my-2 w-100 mx-auto">{sprintf($LNG.loginServerDesc, $gameName)}</p>
	<div style="max-width:300px;" class="form-group contentbox container rounded mx-auto">

				<h1 class="fs-6">{$LNG.loginHeader}</h1>
				<form id="login" action="" method="post">
					<input id="csrfToken" type="hidden" name="csrfToken" value="{$csrfToken}">
					<input id="rememberedEmail" type="hidden" name="rememberedEmail" value="{$rememberedEmail}">
					<input id="rememberedTokenSelector" type="hidden" name="rememberedTokenSelector" value="{$rememberedTokenSelector}">
					<input id="rememberedTokenValidator" type="hidden" name="rememberedTokenValidator" value="{$rememberedTokenValidator}">
					<div class="d-flex flex-column form-group">
						<select class="form-select my-2 w-100" name="uni" id="universe" >
							{foreach $universeSelect as $universeID => $currentUniverse}
								<option class="fs-6" {if $currentUniverse == $rememberedUniverseID}selected{/if} value="{$universeID}">{$currentUniverse}</option>
							{/foreach}
						</select>
						<input class="form-control fs-6 my-2 w-100" id="userEmail" type="text" name="userEmail" placeholder="{$LNG.login_email}" value="{if !empty($rememberedEmail) && $rememberedEmail}{$rememberedEmail}{/if}">
						<input class="form-control fs-6 my-2 w-100" id="password" type="password" name="password" placeholder="{$LNG.loginPassword}" value="{if $rememberedPassword}password{/if}">
						{if $recaptchaEnable && $use_recaptcha_on_login}
								<div style="overflow:hidden;" class="g-recaptcha form-group w-100 fs-6 my-2 mx-auto d-flex justify-content-start" data-sitekey="{$recaptchaPublicKey}"></div>
						{/if}

						<div class="form-group d-flex align-items-center justify-content-start my-2">
							<input id="remember_me" type="checkbox" name="remember_me" {if $rememberedPassword}checked{/if} value="">
							<span class="fs-6 px-2">Remember me</span>
						</div>

						<button id="loginButton" class="hover-bg-color-grey btn bg-dark text-white w-100" type="button" onclick="loginSubmit(activeRecaptcha = '{$recaptchaEnable}', use_recaptcha_on_login = '{$use_recaptcha_on_login}');">{$LNG.loginButton}</button>

					</div>

				</form>
				{if $facebookEnable}
					<a href="#" data-href="index.php?page=externalAuth&method=facebook" class="fb_login">
						<img src="styles/resource/images/facebook/fb-connect-large.png" alt="">
					</a>
				{/if}

				<a class="hover-bg-color-grey btn btn-block w-100 bg-dark text-white my-2 fs-6" href="index.php?page=register">{$LNG.buttonRegister}</a>

				<span class="fs-6">{$loginInfo}</span>

				{if $mailEnable}
					<a class="hover-bg-color-grey btn btn-block w-100 bg-dark text-white my-2 fs-6" href="index.php?page=lostPassword">{$LNG.buttonLostPassword}</a>
				{/if}

	</div>

{/block}

{if $recaptchaEnable && $use_recaptcha_on_login}
	{block name="script" append}
		<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
	{/block}

	{block name="script" append}
		<script type="text/javascript" src="./scripts/base/avoid_submit_on_refresh.js"></script>
	{/block}

{/if}
