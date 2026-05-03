{extends file='layout/base.tpl'}

{block name='title'}Category Articles - Articles{/block}

{block name='content'}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Category: {$page->categoryName}</h1>
        </div>
    </section>

    <section class="articles-list">
        <div class="container">
            <div class="articles-grid">
                {foreach $page->articles as $article}
                    {include file='layout/article_card.tpl' article=$article}
                {/foreach}
            </div>
        </div>
    </section>
{/block}
