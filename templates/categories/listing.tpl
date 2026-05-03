{extends file='layout/base.tpl'}

{block name='title'}Categories - Articles{/block}

{block name='content'}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Explore by Category</h1>
            <p class="page-description">Browse our curated collection of articles across various business domains.</p>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <div class="categories-grid">
                {foreach $page->categories as $category}
                    <a href="/category/get/{$category->slug}" class="category-card">
                        <h3 class="category-name">{$category->name}</h3>
                    </a>
                {/foreach}
            </div>
        </div>
    </section>
{/block}
