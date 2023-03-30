<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <title><?= $title ?? '' ?></title>
</head>

<body>
    <main>
        <div class="wrapper">
            <h1>Список текущих задач</h1>
            <div>Сортировать по:
                <select id="sortingList" class="sorting light">
                    <option value="?sort=date">Дате (сначала старые)</option>
                    <option value="?sort=date&order=DESC">Дате (сначала новые)</option>
                    <option value="?sort=username">Имени пользователя</option>
                    <option value="?sort=email">Email пользователя</option>
                    <option value="?sort=status">Статусу</option>
                </select>
            </div>
            <?= $content ?>
            <div class="pages">
                <?php if ($currentPage > 1) : ?>
                    <a href="/<?= htmlspecialchars($queryLink, ENT_QUOTES) ?>">В начало</a>
                    <a href="/<?= ($currentPage - 1) . htmlspecialchars($queryLink, ENT_QUOTES) ?>"><?= $currentPage - 1 ?></a>
                <?php endif; ?>
                <span><?= $currentPage ?></span>
                <?php if ($currentPage < $pagesCount) : ?>
                    <a href="/<?= ($currentPage + 1) . htmlspecialchars($queryLink, ENT_QUOTES) ?>"><?= $currentPage + 1 ?></a>
                    <a href="/<?= $pagesCount . htmlspecialchars($queryLink, ENT_QUOTES) ?> ">В конец</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="/js/tasklist.js"></script>
</body>

</html>