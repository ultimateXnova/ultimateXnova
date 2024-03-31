{include file="ins_header.tpl"}
<tr>
	<td class="left">
		<h2>{$LNG.step1_head}</h2>
		<p>{$LNG.step1_desc}</p>
		<form action="index.php?mode=install&step=4" method="post">
		<input type="hidden" name="post" value="1">
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="host">{$LNG.step1_mysql_server}</label>
			<input id="host" type="text" name="host" class="form-control py-1 bg-dark text-white my-1 border border-secondary" placeholder="localhost" value="{if isset($smarty.get.host)}{$smarty.get.host|escape:'htmlall'|default:$host}{else}db{/if}" size="30">
		</div>
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="port">{$LNG.step1_mysql_port}</label>
			<input id="port" type="text" name="port" class="form-control py-1 bg-dark text-white my-1 border border-secondary" placeholder="3306" value="{if isset($smarty.get.port)}{$smarty.get.port|escape:'htmlall'|default:'3306'}{else}3306{/if}" size="30">
		</div>
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="user">{$LNG.step1_mysql_dbuser}</label>
			<input id="user" type="text" name="user" class="form-control py-1 bg-dark text-white my-1 border border-secondary" value="{if isset($smarty.get.user)}{$smarty.get.user|escape:'htmlall'|default:$user}{else}uxn_user{/if}" size="30">
		</div>
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="passwort">{$LNG.step1_mysql_dbpass}</label>
			<input id="passwort" type="password" name="passwort" autocomplete="new-password" class="form-control py-1 bg-dark text-white my-1 border border-secondary" value="uxn_password" size="30">
		</div>
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="dbname">{$LNG.step1_mysql_dbname}</label>
			<input id="dbname" type="text" name="dbname" class="form-control py-1 bg-dark text-white my-1 border border-secondary" value="{if isset($smarty.get.dbname)}{$smarty.get.dbname|escape:'htmlall'|default:$dbname}{else}ultimatexnova{/if}" size="30">
		</div>
		<div class="form-group">
			<label class="text-start my-1 cursor-pointer hover-underline user-select-none" for="prefix">{$LNG.step1_mysql_prefix}</label>
			<input id="prefix" type="text" name="prefix" class="form-control py-1 bg-dark text-white my-1 border border-secondary" value="{if isset($smarty.get.prefix)}{$smarty.get.prefix|escape:'htmlall'|default:'uni1_'}{else}uxn_{/if}" size="30">
		</div>
		<div class="form-group">
			<input type="submit" name="next" class="btn btn-primary text-white my-2 w-100" value="{$LNG.continue}">
		</div>


		</form>
	</td>
</tr>
{include file="ins_footer.tpl"}
