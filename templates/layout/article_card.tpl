<div class="article-card">
    <div class="card-image">
        <img src="{$article->imageUrl}" alt="{$article->title}">
{*        <span class="category-badge">{$post.category|default:'General'}</span>*}
    </div>
    <div class="card-content">
        <span class="post-date">{$article->createdAt|date_format:"%Y-%m-%d %H:%M"}</span>
        <h3 class="post-title"><a href="/article/get/{$article->slug}">{$article->title}</a></h3>
        <p class="post-excerpt">{$article->content|truncate:100}</p>
        <div class="card-footer">
            <a href="/article/get/{$article->slug}" class="read-more">Read More <span class="arrow">&rarr;</span></a>
        </div>
    </div>
</div>
