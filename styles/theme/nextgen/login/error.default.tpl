{block name="title" prepend}{$LNG.fcm_info}{/block}
{block name="content"}
<table class="table519">
	<tr>
		<td>
			<p>{if isset ($message) }{$message}{/if}</p>
			{if !empty($redirectButtons)}
			<p>
				{foreach $redirectButtons as $button}
				<a href="{if is_array($button) && isset($button.label)}{$button.url}{/if}"><button>
					{if is_array($button) && isset($button.label)}
						{$button.label}
					{/if}
				</button>
			</a>
			{/foreach}
		</p>
		{/if}
	</td>
	</tr>
</table>
{/block}
