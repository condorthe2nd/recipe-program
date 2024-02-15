<?php
// Declare the global variable for the database connection
global $recipe_database;

// Include the database connection file
require('mySQL.php');

// Get the recipe ID from the URL
$id = $_GET['id'];

// Prepare a SQL statement to select all fields from the recipes table where the id matches the one from the URL
$query = "SELECT * FROM recipes WHERE id = $id";

// Execute the SQL statement
$result = mysqli_query($recipe_database, $query);

// Check if the query was successful and if there is at least one record returned
if ($result && mysqli_num_rows($result) > 0) {
    // If so, fetch the record as an associative array
    $recipe = mysqli_fetch_assoc($result);

    // Print an HTML form with the recipe data pre-filled
    echo '<link rel="stylesheet" type="text/css" href="style.css">';
    include 'header.html';
    echo '<form action="update_recipe.php" method="post">';
    echo '<p>Recipe Name: <input type="text" name="recipe_name" value="'
        . htmlspecialchars($recipe['recipe_name']) . '"></p>';
    echo '<p>Ingredients: <textarea name="ingredients">'
        . htmlspecialchars($recipe['ingredients'])
        . '</textarea></p>';
    echo '<p>Instructions: <textarea name="instructions">'
        . htmlspecialchars($recipe['instructions'])
        . '</textarea></p>';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<p><input type="submit" value="Update Recipe"></p>';
    echo '</form>';
} else {
    // If the query was not successful or no records were returned, print an error message
    echo '<p>Recipe not found.</p>';
}

// Close the connection to the database
mysqli_close($recipe_database);
?>