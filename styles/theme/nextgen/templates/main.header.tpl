<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$lang}" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="{$lang}" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="{$lang}" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="{$lang}" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="{$lang}" class="no-js {$bg_img}"> <!--<![endif]-->
<head>
	<title>{block name="title"} - {$uni_name} - {$game_name}{/block}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- Bootstrap 5 - No IE support -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">




	{if !empty($goto)}
	<meta http-equiv="refresh" content="{$gotoinsec};URL={$goto}">
	{/if}
	{assign var="REV" value="1.0.0.174" nocache}

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="./styles/resource/css/base/boilerplate.css?v={$REV}">
	<link rel="stylesheet" type="text/css" href="./styles/resource/css/base/jquery.css?v={$REV}">
	<link rel="stylesheet" type="text/css" href="./styles/resource/css/base/validationEngine.jquery.css?v={$REV}">
	<link rel="stylesheet" type="text/css" href="{$dpath}formate.css?v={$REV}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css">
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">

	<!-- NG Fonts -->
	<link rel="stylesheet" href="styles/theme/nextgen/css/fonts.css">
	<!-- NG Libraries -->
	<link rel="stylesheet" href="styles/theme/nextgen/css/uikit.min.css">
	<script src="styles/theme/nextgen/js/uikit.min.js	"></script>
	<script src="styles/theme/nextgen/js/uikit-icons.min.js"></script>
	<!-- NG CSS -->
	<link rel="stylesheet" href="styles/theme/nextgen/css/style.css">
	<link rel="stylesheet" href="styles/theme/nextgen/css/mobile.css">
	<!-- Favicons  -->
	<link rel="shortcut icon" href="/styles/resource/favicon/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="180x180" href="/styles/resource/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/styles/resource/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/styles/resource/favicon/favicon-16x16.png">
	<link rel="manifest" href="/styles/resource/favicon/site.webmanifest">

	<script type="text/javascript">
	var ServerTimezoneOffset = {$Offset};
	var serverTime 	= new Date({$date.0}, {$date.1 - 1}, {$date.2}, {$date.3}, {$date.4}, {$date.5});
	var startTime	= serverTime.getTime();
	var localTime 	= serverTime;
	var localTS 	= startTime;
	var Gamename	= document.title;
	var Ready		= "{$LNG.ready}";
	var Skin		= "{$dpath}";
	var Lang		= "{$lang}";
	var head_info	= "{$LNG.fcm_info}";
	var auth		= {$authlevel|default:'0'};
	var days 		= {$LNG.week_day|json|default:'[]'}
	var months 		= {$LNG.months|json|default:'[]'} ;
	var tdformat	= "{$LNG.js_tdformat}";
	var queryString	= "{$queryString|escape:'javascript'}";
	var isPlayerCardActive	= "{$isPlayerCardActive|json}";
	var relativeTime = Math.floor(Date.now() / 1000);
	var attackListenTime = {$attackListenTime};

	setInterval(function() {
		if(relativeTime < Math.floor(Date.now() / 1000)) {
		serverTime.setSeconds(serverTime.getSeconds()+1);
		relativeTime++;
		}
	}, 1);
	</script>



	<script type="text/javascript" src="./scripts/base/jquery.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/base/jquery.ui.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/base/jquery.cookie.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/base/jquery.validationEngine.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/l18n/validationEngine/jquery.validationEngine-{$lang}.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/base/tooltip.js?v={$REV}"></script>
	<script type="text/javascript" src="./scripts/game/base.js?v={$REV}"></script>
	{foreach item=scriptname from=$scripts}
	<script type="text/javascript" src="./scripts/game/{$scriptname}.js?v={$REV}"></script>
	{/foreach}
	{if isModuleAvailable($smarty.const.MODULE_ATTACK_ALERT)}
	<script type="text/javascript">
	var attackListenTime = {$attackListenTime};
	</script>
	<script type="text/javascript" src="./scripts/game/attackAlert.js?v={$REV}"></script>
	{/if}
	<!-- fancybox 5.0 -->
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

<script>
		var myDefaultWhiteList = bootstrap.Tooltip.Default.allowList
		myDefaultWhiteList.table = ['class','style'];
		myDefaultWhiteList.tbody = [];
		myDefaultWhiteList.thead = [];
		myDefaultWhiteList.th = ['colspan'];
		myDefaultWhiteList.tr = [];
		myDefaultWhiteList.td = ['colspan','style'];
		myDefaultWhiteList.span = ['class','onclick'];
		myDefaultWhiteList.img = ['src','alt','width','height'];
		myDefaultWhiteList.form = ['class','action','method'];
		myDefaultWhiteList.input = ['type','name','value'];
		myDefaultWhiteList.button = ['type','class','onclick','style'];
		myDefaultWhiteList.font = ['color'];
		myDefaultWhiteList.a = ['href','class','onclick'];
		myDefaultWhiteList.br = [];

			//initialize bootstrap tooltips
			$(document).ready(function(){
			  $('[data-bs-toggle="tooltip"]').tooltip({
					container: 'body',
				  html: true,
				  whiteList: myDefaultWhiteList
				});
			});

			// To allow elements
			//popovers

			$(document).ready(function(){
				$('[data-bs-toggle="popover"]').popover({
					container: 'body',
				  html: true,
					whiteList: myDefaultWhiteList
				});

			});
</script>

<script src="scripts/game/overview.js"></script>

</head>
<body id="{if isset($smarty.get.page)}{$smarty.get.page|htmlspecialchars|default:'overview'}{/if}" class="{$bodyclass}">
	<div id="tooltipNotify" class="tip"></div>
