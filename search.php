<?php
/*
 * This is the script that the form on index.php submits to
 * Its job is to:
 * 1. Get the data from the form request
 * 2. Load the books and then filter them based on the search term
 * 3. Store the results in the SESSION
 * 4. Redirect the visitor back to index.php
 */

# We'll be storing data in the session, so initiate it
session_start();

# Not strictly necessary, but helpful if you need to use the dump statement when debugging
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

# Store our results data in the SESSION so it's available when we redirect back to index.php
$_SESSION['results'] = [
    'searchTerm' => $searchTerm,
    'books' => $books,
    'bookCount' => count($books),
    'caseSensitive' => $caseSensitive,
];

# Redirect back to the form on index.php
header('Location: index.php');