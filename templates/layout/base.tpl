<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name='title'}Articles{/block}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    {block name='head'}{/block}
</head>
<body>
<div class="app-wrapper">
    {include file='layout/header.tpl'}

    <main class="main-content">
        {block name='content'}{/block}
    </main>

    {include file='layout/footer.tpl'}
</div>
</body>
</html>