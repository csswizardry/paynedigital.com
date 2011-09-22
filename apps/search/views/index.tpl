{extends file='default/views/base.tpl'}
{block name='body'}
    <div class='page-header'>
        <h2>Results for '{$search_query|htmlentities8}'</h2>
    </div>
    <div id='posts'>
        {foreach from=$posts item="post" name="posts"}
            {include file='blog/views/partials/post.tpl'}
        {foreachelse}
            <p>Sorry - no posts match this query. This search facility will be
            improved over time to actually search the entire site but for now
            is limited to only searching blog post titles and tags.</p>
        {/foreach}
    </div>
{/block}