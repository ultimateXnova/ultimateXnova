
{block name="title" prepend}{$LNG.lm_overview}{/block}
{block name="content"}

<form method="POST" action="game.php?page=relocate&mode=send">
<table class="table table-gow fs-12 w-100">
  <tr>
    <th colspan="3">
      <span class="color-blue">{ucwords($LNG['rl_relocate'])}</span>
    </th>
  </tr>
  <tr>
    <td colspan="3">
      <span class="fs-12 text-gray">{$info}</span>
    </td>
  </tr>
  <tr>
    <td>
      <input style="height:24px;" class="form-control bg-dark text-white text-center" name="galaxy" size="20" value="{$galaxy}" type="text" placeholder="Galaxy">
    </td>
    <td>
      <input style="height:24px;" class="form-control bg-dark text-white text-center" name="system" size="20" value="{$system}" type="text" placeholder="System">
    </td>
    <td>
      <input style="height:24px;" class="form-control bg-dark text-white text-center" name="planet" size="20" value="{$planet}" type="text" placeholder="Planet">
    </td>
  </tr>
  <tr>
    <td class="text-center" colspan="3">
      <input class="btn btn-dark py-0 px-1 border border-secondary fs-12 text-yellow" value="{ucwords($LNG.rl_relocate)}" type="submit">
    </td>
  </tr>
</table>
</form>

<div class="item_list">
	<div class="relocate_wrapper">
		<span class="info_text blue thick"></span>

	</div>
</div>


{/block}
