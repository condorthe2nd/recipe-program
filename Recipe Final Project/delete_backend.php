<?php
// Include the database connection file
require("mySQL.php");

// Declare the global variable for the database connection
global $recipe_database;

// Set the page title
$page_title = 'Delete a Recipe';

// Include the header file which likely contains the HTML structure and CSS for the page
include("header.html");

// Print the main heading for the page
echo '<h1>Delete a Recipe</h1>';

// Initialize the id variable
$id = 0;

// Check if the id parameter is set in the GET request and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // If so, assign the id parameter to the id variable
    $id = $_GET['id'];
} else {
    // If not, print an error message and exit the script
    echo '<p class="error">This page has been accessed in error.</p>';
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If so, check if the 'sure' field is set to 'Yes'
    if (isset($_POST['sure']) && $_POST['sure'] == 'Yes') {
        // If so, prepare a SQL statement to delete the recipe with the given id from the database
        $stmt = $recipe_database->prepare("DELETE FROM recipes WHERE id = ?");
        $stmt->bind_param("i", $id);
        // Execute the statement and check if the deletion was successful
        if ($stmt->execute() && $stmt->affected_rows == 1) {
            // If so, redirect the user to the main page
            header('Location: main%20page.php');
        } else {
            // If not, print an error message
            echo '<p class="error">The recipe could not be deleted due to a system error.</p>';
            echo '<p>' . $stmt->error . '</p>';
        }
        // Close the statement
        $stmt->close();
    } else {
        // If the 'sure' field is not set to 'Yes', print a message indicating that the recipe has not been deleted
        echo '<p>The recipe has NOT been deleted.</p>';
    }
} else {
    // If the request method is not POST, prepare a SQL statement to select the recipe name from the database for the given id
    $stmt = $recipe_database->prepare("SELECT recipe_name FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the recipe exists
    if ($result->num_rows == 1) {
        // If so, print the recipe name and a form asking the user if they are sure they want to delete the recipe
        $row = $result->fetch_assoc();
        echo "<h3>Name: " . htmlspecialchars($row['recipe_name']) . "</h3>
              Are you sure you want to delete this recipe?";
        echo '<br><a href="recipe_list.php">Back</a>';
        echo '<form action="delete_backend.php?id=' . $id . '" method="post">
                <input type="radio" name="sure" value="Yes" /> Yes
                <input type="radio" name="sure" value="No" checked="checked" /> No
                <input type="submit" name="submit" value="Submit" />
                <input type="hidden" name="id" value="' . $id . '" />
              </form>';
    } else {
        // If the recipe does not exist, print an error message
        echo '<p class="error">This page has been accessed in error.</p>';
    }
    // Close the statement
    $stmt->close();
}

// Close the connection to the database
mysqli_close($recipe_database);
?>