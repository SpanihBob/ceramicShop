<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $articles = [
        [
            'title' => 'Создание динамических страниц',
            'content' => 'Текст статьи про динамические страницы.'
        ],
        [
            'title' =>  'Как поймать котёнка',
            'content' => 'Текст статьи про котят.'
        ]
    ];
?>

<!-- Выводим меню -->
<a href="/">Главная</a>
<br>
<?php foreach($articles as $id => $article): ?>
    <a href="/index.php?id=<?= $id ?>"><?= $article['title'] ?></a>
    <br>
<?php endforeach; ?>

<?php
// Если id нет в URL - отображаем главную страницу
if(!isset($_GET['id']))
    echo '<h1>Главная</h1>';

// Если id есть, но нет статьи с таким id - показываем ошибку
elseif(!isset($articles[$_GET['id']]))
    echo '<h1>Ошибка: страница не существует.</h1>';

// Если id есть и статья с таким id существует - выводим статью
else
{
    $article = $articles[$_GET['id']];

    echo '<h1>' . $article['title'] . '</h1>';
    echo '<p>' . $article['content'] . '</p>';
}
?>
</body>
</html>