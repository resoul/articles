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
                {foreach $categories as $category}
                    <a href="/category/{$category.slug}" class="category-card">
                        <div class="category-icon">{$category.icon|default:'📁'}</div>
                        <h3 class="category-name">{$category.name}</h3>
                        <p class="category-count">{$category.count|default:0} Articles</p>
                    </a>
                {/foreach}
            </div>
        </div>
    </section>
{/block}
