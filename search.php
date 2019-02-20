<?php
/*
 * This is the script that the form on index.php submits to
 * Its job is to:
 * 1. Get the data from the form request
 * 2. Load the books and then filter them based on the search term
 * 3. Store the results in the SESSION
 * 4. Redirect the visitor back to index.php
 */
require 'includes/helpers.php';
require 'Book.php';
require 'Form.php';

use Foobooks0\Book;
use DWA\Form;

# We'll be storing data in the session, so initiate it
session_start();

# Instantiate our objects
$book = new Book('books.json');
$form = new Form($_POST);

# Get data from form request
$searchTerm = $form->get('searchTerm');
$caseSensitive = $form->has('caseSensitive');

# Validate the form data
$errors = $form->validate([
    'searchTerm' => 'required'
]);

if(!$form->hasErrors) {
    $books = $book->getByTitle($caseSensitive, $searchTerm);
}

# Store our results data in the SESSION so it's available when we redirect back to index.php
$_SESSION['results'] = [
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'searchTerm' => $searchTerm,
    'books' => $books ?? null,
    'bookCount' => isset($books) ? count($books) : 0,
    'caseSensitive' => $caseSensitive,
];

# Redirect back to the form on index.php
header('Location: index.php');