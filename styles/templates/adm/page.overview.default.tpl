{block name="content"}

	<h1 class="fs-4 text-white">{$LNG.ow_title}</h1>
	<table class="table table-dark table-striped table-sm fs-12 w-50 my-5 mx-auto" style="border:2px {if empty($Messages)}lime{else}red{/if} solid;text-align:center;font-weight:bold;">
		<tr>
			<td class="transparent">{foreach item=Message from=$Messages}
					<span style="color:red">{$Message}</span><br>
					{foreachelse}{$LNG.ow_none}{/foreach}
			</td>
		</tr>
	</table>
	<table class="table table-dark table-striped table-sm fs-12 w-50 my-5 mx-auto">
		<tr>
			<th colspan="2">{$LNG.ow_overview}</th>
		</tr>
		<tr>
			<td style="height:50px" colspan="2">{$LNG.ow_welcome_text}
        <iframe src="https://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2F2Moons%2F129282307106646&amp;width=292&amp;connections=0&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>
			</td>
		</tr>
		<tr>
			<th colspan="2">{$LNG.ow_support}</th>
		</tr>
		<tr>
			<td colspan="2"><a href="https://github.com/ultimateXnova/ultimateXnova/" target="_blank">Project Homepage</a>
				<a target="_blank" href="https://github.com/ultimateXnova/ultimateXnova/issues" target="_blank">GitHub Issues - <!--{$LNG.ow_forum}--></a>
				<a target="_blank" href="https://discord.gg/TUzu8AWPKM" target="_blank">Discord</a>
				</td>
		</tr>
		<tr>
			<th colspan="2">{$LNG.ow_updates}</th>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<div id="feed"></div>
			</td>
		</tr>

		<tr>
			<th colspan="2">{$LNG.ow_credits}</th>
		</tr>
		<tr>
			<td colspan="2">
				<table align="center">
					<tr>
						<td class="transparent" colspan="3"><h3>{$LNG.ow_proyect_leader}</h3></td>
					</tr>
					<tr>
						<td class="transparent" colspan="3"><h3><a target="_blank" href="https://github.com/Pfahli" style="color:red">Pfahli</a></h3></td>
					</tr>
				</table>
				<div style="width:100%">
				<div style="float:left;width:33%;min-width:250px;">
					<table>
						<tr>
							<td class="transparent"><p>&nbsp;</p><h3>{$LNG.ow_developers}</h3></td>
						</tr>
						<tr>
							<td class="transparent">
								<a target="_blank" href="https://github.com/Pfahli" style="color:rgb(0, 179, 255)">Pfahli</a> (ultimateXnova)<br>
								<a target="_blank" href="https://github.com/koraykarakus" style="color:red">koraykarakus</a> (SteemNova)<br>
								<a target="_blank" href="https://github.com/IntinteDAO" style="color:red">IntinteDAO</a> (SteemNova)<br>
								<a target="_blank" href="https://github.com/mys" style="color:red">mys</a> (SteemNova)<br>
								<a target="_blank" href="https://github.com/jkroepke" style="color:rgb(18, 177, 0)">Jan</a> (2Moons)<br>
							</td>
						</tr>
					</table>
				</div>
					<div style="float:left;width:50%;min-width:250px;">
						<table>
							<tr>
								<td class="transparent"><p>&nbsp;</p><h3>{$LNG.ow_translator}</h3></td>
							</tr>
							<tr>
								<td class="transparent">
									<table width="250px;">
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/us.png" alt="(english)">
											</td>
											<td class="transparent left">
												QwataKayean
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/pt.png" alt="(portuguese)">
											</td>
											<td class="transparent left">
												QwataKayean
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/fr.png" alt="(french)">
											</td>
											<td class="transparent left">
												<a href="https://github.com/BigTwoProduction" target="_blank">BigTwoProduction</a>
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/ru.png" alt="(russian)">
											</td>
											<td class="transparent left">
												InquisitorEA
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/es.png" alt="(spanish)">
											</td>
											<td class="transparent left">
												Orion
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/tr.png" alt="(turkish)">
											</td>
											<td class="transparent left">
												romansmac
											</td>
										</tr>
										<tr>
											<td class="transparent">
												<img src="styles/resource/images/login/flags/it.png" alt="(italian)">
											</td>
											<td class="transparent left">
												Dany92
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<div style="float:left;width:50%;min-width:250px;">
						<table>
							<tr>
								<td class="transparent"><p>&nbsp;</p><h3>{$LNG.ow_special_thanks}</h3></td>
							</tr>
							<tr>
								<td class="transparent">
									<table width="250px;">
										<tr>
											<td class="transparent left"><a href="https://github.com/Hilarious001" target="_blank">Hilarious001</a></td>
											<td class="transparent left">Ralf M.</td>
											<td class="transparent left">InquisitorEA</td>
										</tr>
										<tr>
											<td class="transparent left">lucky</td>
											<td class="transparent left">Metusalem</td>
											<td class="transparent left">Meikel</td>
										</tr>
										<tr>
											<td class="transparent left">Phil</td>
											<td class="transparent left">Schnippi</td>
											<td class="transparent left">Vobi</td>
										</tr>
										<tr>
											<td class="transparent left">Sycrog</td>
											<td class="transparent left">Raito</td>
											<td class="transparent left">Chlorel</td>
										</tr>
										<tr>
											<td class="transparent left">e-Zobar</td>
											<td class="transparent left">Flousedid</td>
											<td class="transparent left">jstar</td>
										</tr>
										<tr>
											<td class="transparent left">scrippi</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
	</table>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("feeds", "1");
	google.setOnLoadCallback(initialize);
	function initialize() {
		var feedControl = new google.feeds.FeedControl();
		feedControl.addFeed("https://github.com/ultimateXnova/ultimateXnova/commits/master.atom", "");
		//feedControl.addFeed("http://code.google.com/feeds/p/2moons/svnchanges/basic", "");
		feedControl.draw(document.getElementById("feed"));
		//var feedControl = new google.feeds.FeedControl();
        //feedControl.addFeed("https://www.facebook.com/feeds/page.php?id=129282307106646&format=rss20", "");
        //feedControl.draw(document.getElementById("news"));
	}
</script>

{/block}
