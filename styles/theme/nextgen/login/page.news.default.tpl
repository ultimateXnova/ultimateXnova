{block name="title" prepend}{$LNG.siteTitleNews}{/block}
{block name="content"}<h1>{$LNG.siteTitleNews}</h1>
{foreach $newsList as $newsRow}
{if !$newsRow@first}<hr>{/if}
<div class="box-border dark-blur-bg box-shadow-large">
    <h1 class="login-heading">{$newsRow.title}</h1>
    <div class="info">{$newsRow.from}</div>
    <br><div><p>{$newsRow.text}</p></div>
</div>
    {foreachelse}
<div class="box-border dark-blur-bg box-shadow-large">
    <h1 class="login-heading">{$LNG.news_does_not_exist}</h1>
</div>
{/foreach}
{/block}