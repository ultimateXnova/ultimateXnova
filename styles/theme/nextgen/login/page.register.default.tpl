{block name="title" prepend}{$LNG.siteTitleRegister}{/block}
{block name="content"}

<script>
	function registerSubmit(activeRecaptcha, use_recaptcha_on_register,referralID){
		var recaptchaResponse = false;

		if (activeRecaptcha == 1 && use_recaptcha_on_register == 1) {
			recaptchaResponse = grecaptcha.getResponse();
		}


		$.ajax({
				type: "POST",
				url: 'index.php?page=register&mode=send&ajax=1',
				data: {
					userName: $("#username").val(),
					password: $("#password").val(),
					email: $("#email").val(),
					secretQuestion: $("#secretQuestion").val(),
					secretQuestionAnswer: $('#secretQuestionAnswer').val(),
					language: $('#language option:selected').val(),
					rules: $('#rules').is(':checked'),
					referralID : $('#referralID').val(),
					g_recaptcha_response: recaptchaResponse,
					csrfToken: $('#csrfToken').val(),
				},
				success: function(data)
				{
					var dataParsed = jQuery.parseJSON(data);

					$('.alert').remove();

					if (dataParsed.status == 'fail') {
						if (activeRecaptcha == 1 && use_recaptcha_on_register == 1) {
							grecaptcha.reset();
						}

						$.each( dataParsed, function( typeError, errorText ) {

							if (typeError == 'status') {
								return;
							}

							$('#registerButton').before("<span class='alert alert-danger fs-6 py-1 my-1'>"+ errorText +"</span>")
						});

					}else if (dataParsed.status == 'success') {
						$('#registerButton').before("<span class='alert alert-success fs-6 py-1 my-1'>"+ dataParsed.successMessage +"</span>")
					}else if (dataParsed.status == 'redirect') {
						location.href = dataParsed.url;
					}

				}

		});

	}
</script>
<div class="box-border dark-blur-bg box-shadow-large register-container">
<h1 class="login-heading">{$LNG.siteTitleRegister}</h1>
	<form style=""  id="registerForm" method="post" action="index.php?page=register" data-action="index.php?page=register">
		<input id="csrfToken" type="hidden" name="csrfToken" value="{$csrfToken}">
		<input type="hidden" value="send" name="mode">
		<input type="hidden" value="{$externalAuth.account}" name="externalAuth[account]">
		<input type="hidden" value="{$externalAuth.method}" name="externalAuth[method]">
		<input id="referralID" type="hidden" value="{$referralData.id}" name="referralID">
		{if $isMultiUniverse}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="universe">{$LNG.universe}</label>
			<select style="text-indent:5px;" class="bg-dark text-white form-select d-flex align-items-center my-2 fs-6 w-100 mx-0 px-0" name="uni" id="universe" class="changeAction">
			{html_options options=$universeSelect selected=$UNI}
			</select>
		</div>
		{else}
			<input type="hidden" name="uni" value="{$UNI}">
		{/if}
		{if !empty($error.uni)}
			<span class="error errorUni"></span>
		{/if}

		{if !empty($externalAuth.account)}
		{if $facebookEnable}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100">{$LNG.registerFacebookAccount}</label>
			<span class="text fbname">{$accountName}</span>
		</div>
		{/if}
		{elseif empty($referralData.id)}
		{if $facebookEnable}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100">{$LNG.registerFacebookAccount}</label>
			<a href="#" data-href="index.php?page=externalAuth&method=facebook" class="fb_login"><img src="styles/resource/images/facebook/fb-connect-large.png" alt=""></a>
		</div>
		{/if}
		{/if}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="username">{$LNG.registerUsername}</label>
			<input type="text" class="bg-dark text-white form-control d-flex align-items-center my-2 mx-0 px-0 fs-6 w-100" name="username" id="username" maxlenght="32">
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			{if !empty($error.username)}
			<span class="error errorUsername"></span>
			{/if}
			<span class="fs-6 my-2 text-start w-100 text-secondary">{$LNG.registerUsernameDesc}</span>
		</div>

		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="password">{$LNG.registerPassword}</label>
			<input type="password" class="bg-dark text-white form-control d-flex align-items-center my-2 mx-0 px-0 fs-6 w-100" name="password" id="password">
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			{if !empty($error.password)}<span class="error errorPassword"></span>{/if}
			<span class="inputDesc">{$registerPasswordDesc}</span>
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="email">{$LNG.registerEmail}</label>
			<input type="email" class="bg-dark text-white form-control d-flex align-items-center my-2 mx-0 px-0 fs-6 w-100" name="email" id="email">
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			{if !empty($error.email)}<span class="error errorEmail"></span>{/if}
			<span class="inputDesc">{$LNG.registerEmailDesc}</span>
		</div>

		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="secretQuestion">{$LNG.registerSecretQuestionText}</label>
			<select id="secretQuestion" style="text-indent:5px;" class="bg-dark text-white form-select d-flex align-items-center my-2 fs-6 w-100 mx-0 px-0" name="secretQuestion">
				{foreach $LNG.registerSecretQuestionArray as $id => $currentQuestion}
				<option value="{$id}">{$currentQuestion}</option>
				{/foreach}
			</select>
		</div>


		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="secretQuestionAnswer">{$LNG.registerSecretQuestionAnswerText}</label>
			<input id="secretQuestionAnswer" type="text" class="bg-dark text-white form-control d-flex align-items-center my-2 mx-0 px-0 fs-6 w-100" name="secretQuestionAnswer">
		</div>


		{if count($languages) > 1}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="language">{$LNG.registerLanguage}</label>
			<select style="text-indent:5px;" class="bg-dark text-white form-select d-flex align-items-center my-2 fs-6 w-100 mx-0 px-0" name="lang" id="language">
				{html_options options=$languages selected=$lang}
			</select>
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			{if !empty($error.language)}
				<span class="error errorLanguage"></span>
			{/if}
			<div class="clear"></div>
		</div>
		{/if}
		{if !empty($referralData.name)}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100" for="language">{$LNG.registerReferral}</label>
			<span class="text">{$referralData.name}</span>
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			{if !empty($error.language)}<span class="error errorLanguage"></span>{/if}
			<div class="clear"></div>
		</div>
		{/if}
		{if $recaptchaEnable && $use_recaptcha_on_register}
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2">
			<label class="fs-6 my-2 text-start w-100">{$LNG.registerCaptcha}</label>
		</div>
		<div class="form-group d-flex flex-md-row flex-column justify-content-md-between align-items-center my-2" id="captchaRow">
				<div class="g-recaptcha" data-sitekey="{$recaptchaPublicKey}"></div>
				<div class="clear"></div>
		</div>
		{/if}

		<div class="form-group d-flex flex-row justify-content-md-start align-items-center my-2">
			<input type="checkbox" name="rules" id="rules" value="">
			{if !empty($error.rules)}
				<span class="error errorRules"></span>
			{/if}
			<span class="fs-6 px-2">{$registerRulesDesc}</span>
		</div>
		<div class="form-group d-flex flex-column justify-content-md-between align-items-center my-2">
			<button id="registerButton" type="button" onclick="registerSubmit(activeRecaptcha = '{$recaptchaEnable}', use_recaptcha_on_register = '{$use_recaptcha_on_register}', referralID = '{$referralData.id}');" class="hover-bg-color-grey btn btn-block w-100 bg-dark text-white">{$LNG.buttonRegister}</button>
		</div>
	</form>
</div>
{/block}
{block name="script" append}
<link rel="stylesheet" type="text/css" href="styles/resource/css/login/register.css?v={$REV}">
{if $recaptchaEnable && $use_recaptcha_on_register}
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl={$lang}"></script>
{/if}
<script type="text/javascript" src="scripts/login/register.js"></script>
{/block}

{block name="script" append}
<script type="text/javascript" src="./scripts/base/avoid_submit_on_refresh.js"></script>
{/block}
