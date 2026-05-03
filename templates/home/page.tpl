{extends file='layout/base.tpl'}

{block name='title'}Home - Articles{/block}

{block name='content'}
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <span class="hero-tag">Featured Insight</span>
                <h1 class="hero-title">Discover the Future of Business Strategy</h1>
            </div>
        </div>
    </section>

    <section class="latest-articles">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Latest Articles</h2>
                <a href="/article/listing" class="view-all">View All</a>
            </div>
            <div class="articles-grid">
                {foreach $page->articles as $article}
                    {include file='layout/article_card.tpl' article=$article}
                {/foreach}
            </div>
        </div>
    </section>
{/block}
