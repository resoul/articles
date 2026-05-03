{extends file='layout/base.tpl'}

{block name='title'}All Articles - Articles{/block}

{block name='content'}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">All Articles</h1>
            <div class="filter-bar">
                <span class="filter-label">Sort by:</span>
                <form method="get" action="/article/listing">
                    <input type="hidden" name="page" value="1">
                    <input type="hidden" name="perPage" value="{$page->pagination->perPage}">
                    <select
                        class="filter-select"
                        name="sort"
                        onchange="window.location.href=this.value;"
                    >
                        <option
                            value="/article/listing?page=1&perPage={$page->pagination->perPage}&orderBy=id&orderDirection=DESC"
                            {if $page->sorting->orderBy === 'id' && $page->sorting->orderDirection === 'DESC'}selected{/if}
                        >
                            Newest First
                        </option>
                        <option
                            value="/article/listing?page=1&perPage={$page->pagination->perPage}&orderBy=title&orderDirection=ASC"
                            {if $page->sorting->orderBy === 'title' && $page->sorting->orderDirection === 'ASC'}selected{/if}
                        >
                            By Title
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </section>

    <section class="articles-list">
        <div class="container">
            <div class="articles-grid">
                {foreach $page->articles as $article}
                    {include file='layout/article_card.tpl' article=$article}
                {/foreach}
            </div>

            {if $page->pagination->getTotalPages() > 1}
                <div class="pagination">
                    {if $page->pagination->page > 1}
                        <a href="/article/listing?page={$page->pagination->page-1}" class="page-link">&larr;</a>
                    {/if}

                    {for $i=1 to $page->pagination->getTotalPages()}
                        <a href="/article/listing?page={$i}" class="page-link{if $i === $page->pagination->page} active{/if}">{$i}</a>
                    {/for}

                    {if $page->pagination->page < $page->pagination->getTotalPages()}
                        <a href="/article/listing?page={$page->pagination->page+1}" class="page-link">&rarr;</a>
                    {/if}
                </div>
            {/if}
        </div>
    </section>
{/block}
