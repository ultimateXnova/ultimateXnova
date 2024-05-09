{block name="title" prepend}{$LNG.lm_records}{/block} {block name="content"}
<table class="table table-gow fs-12 table-sm">
    <tbody>
        <tr>
            <th colspan="3" style="text-align:center;">{$LNG.rec_last_update_on}: {$update}</th>
        </tr>
        <tr>
            <th width="33%">{$LNG.tech.0}</th>
            <th width="33%">{$LNG.rec_players}</th>
            <th width="33%">{$LNG.rec_level}</th>
        </tr>
        {foreach $buildList as $elementID => $elementRow}
        <tr>
            <td><a href='#' onclick='return Dialog.info({$elementID});' data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-html="true" title="
            <table>
							<thead>
								<tr><th>{$LNG.tech.{$elementID}}</th></tr>
							</thead>
							<tbody>
								<tr>
									<td><img src='{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
								</tr>
								<tr>
									<td>{$LNG.shortDescription.$elementID}</td>
								</tr>
							</tbody>
						</table>">{$LNG.tech.{$elementID}}</a>
            </td>
            {if !empty($elementRow)}
            <td>{foreach $elementRow as $user}<a href='#' onclick='return Dialog.Playercard({$user.userID});'>{$user.username}</a>{if !$user@last}<br>{/if}{/foreach}</td>
            <td>{$elementRow[0].level|number}</td>
            {else}
            <td>-</td>
            <td>-</td>
            {/if}
        </tr>
        {/foreach}
        <tr>
            <th>{$LNG.tech.100}</th>
            <th>{$LNG.rec_players}</th>
            <th>{$LNG.rec_level}</th>
        </tr>
        {foreach $researchList as $elementID => $elementRow}
        <tr>
            <td><a href='#' onclick='return Dialog.info({$elementID})' data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-html="true" title="
            <table>
							<thead>
								<tr><th>{$LNG.tech.{$elementID}}</th></tr>
							</thead>
							<tbody>
								<tr>
									<td><img src='{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
								</tr>
								<tr>
									<td>{$LNG.shortDescription.$elementID}</td>
								</tr>
							</tbody>
						</table>">{$LNG.tech.{$elementID}}</a></td>
            {if !empty($elementRow)}
            <td>{foreach $elementRow as $user}<a href='#' onclick='return Dialog.Playercard({$user.userID});'>{$user.username}</a>{if !$user@last}<br>{/if}{/foreach}</td>
            <td>{$elementRow[0].level|number}</td>
            {else}
            <td>-</td>
            <td>-</td>
            {/if}
        </tr>
        {/foreach}
        <tr>
            <th>{$LNG.tech.200}</th>
            <th>{$LNG.rec_players}</th>
            <th>{$LNG.rec_count}</th>
        </tr>
        {foreach $fleetList as $elementID => $elementRow}
        <tr>
            <td><a href='#' onclick='return Dialog.info({$elementID})' data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-html="true" title="
            <table>
							<thead>
								<tr><th>{$LNG.tech.{$elementID}}</th></tr>
							</thead>
							<tbody>
								<tr>
									<td><img src='{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
								</tr>
								<tr>
									<td>{$LNG.shortDescription.$elementID}</td>
								</tr>
							</tbody>
						</table>">{$LNG.tech.{$elementID}}</a></td>
            {if !empty($elementRow)}
            <td>{foreach $elementRow as $user}<a href='#' onclick='return Dialog.Playercard({$user.userID});'>{$user.username}</a>{if !$user@last}<br>{/if}{/foreach}</td>
            <td>{$elementRow[0].level|number}</td>
            {else}
            <td>-</td>
            <td>-</td>
            {/if}
        </tr>
        {/foreach}
        <tr>
            <th>{$LNG.tech.400}</th>
            <th>{$LNG.rec_players}</th>
            <th>{$LNG.rec_count}</th>
        </tr>
        {foreach $defenseList as $elementID => $elementRow}
        <tr>
            <td><a href='#' onclick='return Dialog.info({$elementID})' data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-html="true" title="
            <table>
							<thead>
								<tr><th>{$LNG.tech.{$elementID}}</th></tr>
							</thead>
							<tbody>
								<tr>
									<td><img src='{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
								</tr>
								<tr>
									<td>{$LNG.shortDescription.$elementID}</td>
								</tr>
							</tbody>
						</table>">{$LNG.tech.{$elementID}}</a></td>
            {if !empty($elementRow)}
            <td>{foreach $elementRow as $user}<a href='#' onclick='return Dialog.Playercard({$user.userID});'>{$user.username}</a>{if !$user@last}<br>{/if}{/foreach}</td>
            <td>{$elementRow[0].level|number}</td>
            {else}
            <td>-</td>
            <td>-</td>
            {/if}
        </tr>
        {/foreach}
        <tr>
            <th>{$LNG.tech.600}</th>
            <th>{$LNG.rec_players}</th>
            <th>{$LNG.rec_count}</th>
        </tr>
        {foreach $officerList as $elementID => $elementRow}
        <tr>
            <td><a href='#' onclick='return Dialog.info({$elementID})' data-bs-toggle="tooltip"
						data-bs-placement="left"
						data-bs-html="true" title="
            <table>
							<thead>
								<tr><th>{$LNG.tech.{$elementID}}</th></tr>
							</thead>
							<tbody>
								<tr>
									<td><img src='{$dpath}gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}'></td>
								</tr>
								<tr>
									<td>{$LNG.shortDescription.$elementID}</td>
								</tr>
							</tbody>
						</table>">{$LNG.tech.{$elementID}}</a></td>
            {if !empty($elementRow)}
            <td>{foreach $elementRow as $user}<a href='#' onclick='return Dialog.Playercard({$user.userID});'>{$user.username}</a>{if !$user@last}<br>{/if}{/foreach}</td>
            <td>{$elementRow[0].level|number}</td>
            {else}
            <td>-</td>
            <td>-</td>
            {/if}
        </tr>
        {/foreach}
    </tbody>
</table>
{/block}
