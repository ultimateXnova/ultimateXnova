{block name="title" prepend}{$LNG.lm_buddylist}{/block}
{block name="content"}
<form name="buddy" id="buddy" action="game.php?page=buddyList&amp;mode=send&amp;ajax=1" method="post">
<input type="hidden" name="id" value="{$id}">
  <table class="table table-gow table-sm">
    <tr>
      <th class="text-center" colspan="2">{$LNG.bu_request_message}</th>
    </tr>
  	<tr style="height:20px;">
      <td class="fs-12 align-middle">{$LNG.bu_player}</td>
      <td class="fs-12 align-middle">
        <input class="form-control bg-black border border-secondary text-white p-1" type="text" value="{$username} [{$galaxy}:{$system}:{$planet}]" size="40" readonly>
      </td>
    </tr>
  	<tr>
      <td class="fs-12 align-middle">{$LNG.bu_request_text}(<span id="cntChars">0</span> / 5000 {$LNG.bu_characters})</td>
      <td class="fs-12 align-middle">
        <textarea class="form-control bg-black border border-secondary text-white p-1" name="text" id="text" cols="40" rows="10" size="100" onkeyup="$('#cntChars').text($(this).val().length);"></textarea>
      </td>
    </tr>
  	<tr>
      <td class="text-center" colspan="2">
        <input class="btn btn-primary text-white px-2 py-0" type="submit" value="{$LNG.bu_send}">
      </td>
  	</tr>
  </table>
</form>
{/block}
