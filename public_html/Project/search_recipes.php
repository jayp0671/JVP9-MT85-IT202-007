<?php
require_once(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");

// Function to fetch recipe data from the API
function fetchRecipeData($query) {
    $api_url = "https://recipe-by-api-ninjas.p.rapidapi.com/v1/recipe?query=" . urlencode($query);

    // Set up the context for the HTTP request
    $context = stream_context_create([
        "http" => [
            "header" => "X-RapidAPI-Host: recipe-by-api-ninjas.p.rapidapi.com\r\n" .
                        "X-RapidAPI-Key: 90cef3f2d3msh5a039e04edfd513p15fe53jsn5e8c9c175f86"
        ]
    ]);

    // Make the request and get the response
    $response = file_get_contents($api_url, false, $context);

    if ($response === FALSE) {
        // Handle error
        return "Error fetching recipe data";
    } else {
        // Return the response
        return json_decode($response, true); // Decode JSON string into an associative array
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and get the user input
    $recipeSearch = isset($_POST["recipeSearch"]) ? trim($_POST["recipeSearch"]) : "";

    // Validate data
    if (empty($recipeSearch)) {
        echo "Please enter a recipe search query.";
    } else {
        // Fetch recipe data from the API
        $apiResponse = fetchRecipeData($recipeSearch);

        // Display the recipes
        if (!empty($apiResponse)) {
            echo "<h2>Search Results:</h2>";

            $uniqueRecipes = [];

            foreach ($apiResponse as $recipe) {
                // Check if the title is already in the unique recipes list
                $existingTitles = array_column($uniqueRecipes, 'title');

                if (!in_array($recipe['title'], $existingTitles)) {
                    // Add the recipe to the unique recipes list
                    $uniqueRecipes[] = $recipe;

                    echo "<h3>{$recipe['title']}</h3>";
                    $ingredientsArray = explode('|', $recipe['ingredients']);
                    $ingredientsList = '<ul><li>' . implode('</li><li>', $ingredientsArray) . '</li></ul>';
                    echo "<p><strong>Ingredients:</strong> {$ingredientsList}</p>";

                    echo "<p><strong>Servings:</strong> {$recipe['servings']}</p>";
                    echo "<p><strong>Instructions:</strong> {$recipe['instructions']}</p>";
                    echo "<hr>";
                }
            }

            if (empty($uniqueRecipes)) {
                echo "No unique recipes found.";
            }
        } else {
            echo "No recipes found.";
        }
    }
}
?>

<h1>Search and Add Recipes</h1>

<!-- Search Form -->
<form action="search_recipes.php" method="post">
    <label for="recipeSearch">Search for Recipes:</label>
    <input type="text" id="recipeSearch" name="recipeSearch" required>
    <button type="submit" name="searchButton">Search</button>
</form>
