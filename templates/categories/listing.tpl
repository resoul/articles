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

            {if $page->pagination->getTotalPages() > 1}
                <div class="pagination">
                    {if $page->pagination->page > 1}
                        <a href="/category/listing?page={$page->pagination->page-1}" class="page-link">&larr;</a>
                    {/if}

                    {for $i=1 to $page->pagination->getTotalPages()}
                        <a href="/category/listing?page={$i}" class="page-link{if $i === $page->pagination->page} active{/if}">{$i}</a>
                    {/for}

                    {if $page->pagination->page < $page->pagination->getTotalPages()}
                        <a href="/category/listing?page={$page->pagination->page+1}" class="page-link">&rarr;</a>
                    {/if}
                </div>
            {/if}
        </div>
    </section>
{/block}
