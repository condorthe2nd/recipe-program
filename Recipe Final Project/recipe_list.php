<?php
// Include the database connection file
global $recipe_database;
require 'mySQL.php';
echo '<link rel="stylesheet" type="text/css" href="style.css">';
include 'header.html';
// Retrieve sorting, page number, and display number parameters from URL
$sort = $_GET['sort'] ?? 'asc'; // Default to ascending
$current_page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default to page 1
$display = isset($_GET['display']) && in_array($_GET['display'], [5, 10, 15, 20, 25, 50]) ? (int)$_GET['display'] : 10; // Default to 10

// Determine sorting method
$sorting_method = match ($sort) {
    'recipe_desc' => 'ORDER BY recipe_name DESC',
    'creator_asc' => 'ORDER BY creator ASC',
    'creator_desc' => 'ORDER BY creator DESC',
    'date_asc' => 'ORDER BY date_entered ASC',
    'date_desc' => 'ORDER BY date_entered DESC',
    default => 'ORDER BY recipe_name ASC',
};

function fetchAndPrintAllTheRecords($r): void
{
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<br>';
        echo '<div>
                <h2>' . htmlspecialchars($row['recipe_name']) . '</h2>
                <h3>' . htmlspecialchars($row['creator']) . '</h3>
                <p>' . htmlspecialchars($row['ingredients']) . '</p>
                <p>' . htmlspecialchars($row['instructions']) . '</p>
                <a href="edit_recipe.php?id=' . $row['id'] . '">Edit</a>
                <a href="delete_backend.php?id=' . $row['id'] . '">Delete</a>
              </div>';
        echo '<br>';
    }
}

// Dropdown for sorting
echo '
<div class="dropdown Sort-button">
    <button>Sort</button>
    <div class="dropdown-content">
        <a href="recipe_list.php?sort=recipe_asc&display=' . $display . '">Recipe Name Asc</a>
        <a href="recipe_list.php?sort=recipe_desc&display=' . $display . '">Recipe Name Desc</a>
        <a href="recipe_list.php?sort=creator_asc&display=' . $display . '">Chef Asc</a>
        <a href="recipe_list.php?sort=creator_desc&display=' . $display . '">Chef Desc</a>
        <a href="recipe_list.php?sort=date_asc&display=' . $display . '">Date Asc</a>
        <a href="recipe_list.php?sort=date_desc&display=' . $display . '">Date  Desc</a>
    </div>
</div>
';

// Dropdown for changing number of recipes per page
echo '
<form action="recipe_list.php" method="get" class="recipes-per-page-form">
    <label for="display">Recipes per page:</label>
    <select name="display" id="display" onchange="this.form.submit()">
        <option value="5"' . ($display == 5 ? ' selected' : '') . '>5</option>
        <option value="10"' . ($display == 10 ? ' selected' : '') . '>10</option>
        <option value="15"' . ($display == 15 ? ' selected' : '') . '>15</option>
        <option value="20"' . ($display == 20 ? ' selected' : '') . '>20</option>
        <option value="25"' . ($display == 25 ? ' selected' : '') . '>25</option>
        <option value="50"' . ($display == 50 ? ' selected' : '') . '>50</option>
    </select>
    <input type="hidden" name="sort" value="' . $sort . '">
    <input type="hidden" name="page" value="' . $current_page_number . '">
    <noscript><input type="submit" value="Submit"></noscript>
</form>
';

// Count the number of records for pagination
$count = "SELECT COUNT(id) FROM recipes";
$r = @mysqli_query($recipe_database, $count);
if ($r === false) {
    die('Error: ' . mysqli_error($recipe_database));
}
$row = @mysqli_fetch_array($r, MYSQLI_NUM);
$records = $row[0];

// Calculate the number of pages
if ($records > $display) {
    $pages = ceil($records / $display);
} else {
    $pages = 1;
}

// Calculate offset for SQL query
$offset = ($current_page_number - 1) * $display;

// Fetching records from the database with sorting and pagination
$query = "SELECT id, recipe_name, ingredients, creator, instructions FROM recipes $sorting_method LIMIT $display OFFSET $offset";
$reply = mysqli_query($recipe_database, $query);
fetchAndPrintAllTheRecords($reply);

// Display pagination links
for ($i = 1; $i <= $pages; $i++) {
    echo '<a href="recipe_list.php?page=' . $i . '&sort=' . $sort . '&display=' . $display . '">' . $i . '</a> ';
}

// "Previous" and "Next" buttons
if ($current_page_number > 1) {

    echo '<a href="recipe_list.php?page=' . ($current_page_number - 1) . '&sort=' . $sort . '&display=' . $display . '">Previous</a> ';


}
if ($current_page_number < $pages) {

    echo '<a href="recipe_list.php?page=' . ($current_page_number + 1) . '&sort=' . $sort . '&display=' . $display . '">Next</a> ';

}
include 'footer.html';
