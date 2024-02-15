<?php
// Global variable for the recipe database
global $recipe_database;

// Include the database connection file
require('mySQL.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the recipe id, name, ingredients, and instructions from the POST request
    // If not set, default values are provided
    $id = $_POST['id'] ?? 0;
    $recipe_name = $_POST['recipe_name'] ?? '';
    $ingredients = $_POST['ingredients'] ?? '';
    $instructions = $_POST['instructions'] ?? '';

    // Prepare an UPDATE SQL statement to update the recipe details
    $query = "UPDATE recipes SET recipe_name = ?, ingredients = ?, instructions = ? WHERE id = ?";

    // Prepare the SQL statement with the database connection
    $stmt = mysqli_prepare($recipe_database, $query);

    // Bind the parameters to the SQL statement and execute
    mysqli_stmt_bind_param($stmt, 'sssi', $recipe_name, $ingredients, $instructions, $id);
    mysqli_stmt_execute($stmt);

    // Check if the update was successful
    // If not, display an error message
    if (mysqli_stmt_affected_rows($stmt) <= 0) {
        echo '<p>Error updating recipe. Please try again.</p>';
    }

    // Redirect to the main page after the update
    header('Location: main%20page.php');

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($recipe_database);
