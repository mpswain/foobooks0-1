<?php
session_start();

require('includes/helpers.php');

# Get data from form request
$searchTerm = $_POST['searchTerm'];
$caseSensitive = isset($_POST['caseSensitive']);

# Load book data
$booksJson = file_get_contents('books.json');
$books = json_decode($booksJson, true);

# Filter book data according to search term
foreach($books as $title => $book) {
    if($caseSensitive) {
        $match = $title == $searchTerm;
    } else {
        $match = strtolower($title) == strtolower($searchTerm);
    }

    if(!$match) {
        unset($books[$title]);
    }
}

# Store our data in the session
$_SESSION['results'] = [
    'searchTerm' => $searchTerm,
    'books' => $books,
    'bookCount' => count($books),
    'caseSensitive' => $caseSensitive,
];

# Redirect back to the form
header('Location: index.php');