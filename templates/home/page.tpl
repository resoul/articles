{extends file='layout/base.tpl'}

{block name='title'}Home - Articles{/block}

{block name='content'}
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <span class="hero-tag">Featured Insight</span>
                <h1 class="hero-title">Discover the Future of Business Strategy</h1>
                <p class="hero-description">In-depth analysis, expert opinions, and the latest trends in the global market.</p>
                <div class="hero-actions">
                    <a href="/articles" class="btn btn-primary btn-lg">Explore Articles</a>
                    <a href="/about" class="btn btn-outline btn-lg">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-articles">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Latest Articles</h2>
                <a href="/articles" class="view-all">View All</a>
            </div>
            <div class="articles-grid">
                {foreach $posts as $post}
                    {include file='layout/article_card.tpl' post=$post}
                {/foreach}
            </div>
        </div>
    </section>
{/block}
