{include file="main.header.tpl" bodyclass="full"}

<div class="container-fluid">

	<div class="row">
		<div style="width:220px;">
			{include file="main.navigation.tpl" bodyclass="full"}
		</div>
		<div style="width:calc(100% - 250px);">
			<div class="row bg-black py-3 topnav">
				{include file="main.topnav.tpl" bodyclass="full"}
			</div>
			<div class="content">
				{block name="content"}{/block}
			</div>
		</div>
	</div>
	<div class="row">
		{include file="overall_footer.tpl" bodyclass="full"}
	</div>
</div>





</body>
</html>
