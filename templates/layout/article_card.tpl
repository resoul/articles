<div class="article-card">
    <div class="card-image">
        <img src="{$post.image|default:'/images/placeholder.jpg'}" alt="{$post.title}">
        <span class="category-badge">{$post.category|default:'General'}</span>
    </div>
    <div class="card-content">
        <span class="post-date">{$post.date|default:'Oct 21, 2024'}</span>
        <h3 class="post-title"><a href="/post/{$post.id}">{$post.title}</a></h3>
        <p class="post-excerpt">{$post.excerpt|truncate:100}</p>
        <div class="card-footer">
            <a href="/post/{$post.id}" class="read-more">Read More <span class="arrow">&rarr;</span></a>
        </div>
    </div>
</div>
