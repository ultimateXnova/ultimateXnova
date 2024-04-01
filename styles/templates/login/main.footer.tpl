<footer class="position-fixed bottom-0 left-0 d-flex align-items-center m-0 w-100">
<a class="fs-6 m-0 rounded px-2 mb-1" href="https://github.com/ultimateXnova/ultimateXnova/" title="ultimateXnova" target="copy">ultimateXnova</a>
</footer>
</div>
<div id="dialog" style="display:none;"></div>
<script>
var LoginConfig = {
    'isMultiUniverse': {$isMultiUniverse|json},
	'unisWildcast': {$unisWildcast|json},
	'referralEnable' : {$referralEnable|json},
	'basePath' : {$basepath|json}
};
</script>
{if $analyticsEnable}
<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("{$analyticsUID}");
pageTracker._trackPageview();
} catch(err) {}</script>
{/if}
</body>
</html>
