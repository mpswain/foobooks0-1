<?php
/*
 * This is the logic file for index.php; it's job is to check the
 * SESSION for results, and if available, store the results in variables we
 * can display in index.php
 */

session_start();

$hasErrors = false;

# Get `results` data from session, if available
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    $books = $results['books'];
    $searchTerm = $results['searchTerm'];
    $bookCount = $results['bookCount'];
    $caseSensitive = $results['caseSensitive'];
    $errors = $results['errors'];
    $hasErrors = $results['hasErrors'];

    # TIP: Because the key values for $results all match the variable names we set them do,
    # we could simplify the above 6 lines using PHP's extract function:
    #
    # extract($results);
    #
    # http://php.net/manual/en/function.extract.php
}

# Clear session data so our search is cleared when the page is refreshed
session_unset();

 