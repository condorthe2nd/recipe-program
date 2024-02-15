<?php

global $recipe_database;
$page_title = "Add Recipe";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //call the inputs from the form and turn them into variables
    require('mySQL.php');
    $recipe_name = $_POST['recipe_name'];
    $ingredients = $_POST['ingredients'];
    $creator = $_POST['creator'];
    $instructions = $_POST['instructions'];
    //add the recipe to the database
    $q = "INSERT INTO recipes (recipe_name, ingredients, creator, instructions) VALUES ('$recipe_name', '$ingredients', '$creator', '$instructions')";
    $r = @mysqli_query($recipe_database, $q);
    //back to main page
    header('Location: main%20page.php');
}


?>
    <h1><?php echo $page_title ?></h1>
    <link rel="stylesheet" type="text/css" href="style.css">
<?php include 'header.html'; ?>
    //html form for the recipe
    <form action="add_recipe.php" method="post">
        <p>Recipe Name: <input type="text" name="recipe_name" size="15" maxlength="20"
                               value="<?php if (isset($_POST['recipe_name'])) echo $_POST['recipe_name']; ?>"/></p>
        <p>Ingredients: <input type="text" name="ingredients" size="15"
                               value="<?php if (isset($_POST['ingredients'])) echo $_POST['ingredients']; ?>"/></p>
        <p>Creator: <input type="text" name="creator" size="15" maxlength="20"
                           value="<?php if (isset($_POST['creator'])) echo $_POST['creator']; ?>"/></p>
        <p>Instructions: <input type="text" name="instructions" size="15"
                                value="<?php if (isset($_POST['instructions'])) echo $_POST['instructions']; ?>"/></p>
        <p><input type="submit" name="submit" value="Add Recipe"/></p>
    </form>
<?php include 'footer.html'; ?>