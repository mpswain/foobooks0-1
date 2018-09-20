<?php
require('includes/helpers.php');
require('logic.php');
?>

<!DOCTYPE html>
<html lang='en'>
<head>

    <title>Foobooks0</title>
    <meta charset='utf-8'>

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
          rel='stylesheet'
          integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO'
          crossorigin='anonymous'>

    <link href='/styles/app.css' rel='stylesheet'>

</head>
<body>

<h1>Foobooks0</h1>

<p>Foobooks0 is a small library of books. Search below for your favorite.</p>

<form method='POST' action='search.php'>
    <label>Search for a book by title
        <input type='text' name='searchTerm' value='<?php if (isset($searchTerm)) echo $searchTerm ?>'>
    </label>

    <label>
        <input type='checkbox' name='caseSensitive' <?php if(isset($caseSensitive) and $caseSensitive) echo 'checked'?> >
        Case sensitive
    </label>

    <input type='submit' value='Search'>
</form>

<?php if (isset($searchTerm)): ?>
    <div class='alert alert-primary' role='alert'>
        You searched for <em><?= $searchTerm ?></em>
    </div>
<?php endif; ?>

<?php if (isset($bookCount) and $bookCount == 0): ?>
    <div class='alert alert-warning' role='alert'>
        No results found
    </div>
<?php endif; ?>

<?php if (isset($books)): ?>
    <ul class='books'>
        <?php foreach ($books as $title => $book): ?>
            <li class='book'>
                <div class='title'><?= $title ?></div>
                <div class='author'>
                    by <?= $book['author'] ?>
                </div>
                <img src='<?= $book['cover_url'] ?>' alt='Cover photo for the book <?= $title ?>'>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

</body>
</html>