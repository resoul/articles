{extends file='layout/base.tpl'}

{block name='title'}All Articles - Articles{/block}

{block name='content'}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">All Articles</h1>
            <div class="filter-bar">
                <span class="filter-label">Sort by:</span>
                <select class="filter-select">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="popular">Most Popular</option>
                </select>
            </div>
        </div>
    </section>

    <section class="articles-list">
        <div class="container">
            <div class="articles-grid">
                {foreach $posts as $post}
                    {include file='layout/article_card.tpl' post=$post}
                {/foreach}
            </div>

            <div class="pagination">
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <span class="page-dots">...</span>
                <a href="#" class="page-link">10</a>
            </div>
        </div>
    </section>
{/block}
