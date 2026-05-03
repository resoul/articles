{extends file='layout/base.tpl'}

{block name='title'}{$page->title|escape} - Articles{/block}

{block name='content'}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">{$page->title|escape}</h1>
            <p class="page-description">Published: {$page->createdAt->format('Y-m-d H:i')}</p>
        </div>
    </section>

    <section class="article-page">
        <div class="container">
            <article class="article-content">
                <div class="article-cover">
                    <img src="{$page->imageUrl|escape}" alt="{$page->title|escape}">
                </div>
                <div class="article-body">
                    <p>{$page->content|escape|nl2br}</p>
                </div>
            </article>
        </div>
    </section>
{/block}
