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
        //echo "Please enter a recipe search query.";
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

                    // Add form to add recipe to the database
                    echo '<form action="search_recipes.php" method="post">';
                    echo '<input type="hidden" name="recipeTitle" value="' . htmlspecialchars($recipe['title']) . '">';
                    echo '<input type="hidden" name="recipeIngredients" value="' . htmlspecialchars($recipe['ingredients']) . '">';
                    echo '<input type="hidden" name="recipeServings" value="' . intval($recipe['servings']) . '">';
                    echo '<input type="hidden" name="recipeInstructions" value="' . htmlspecialchars($recipe['instructions']) . '">';
                    echo '<input type="hidden" name="recipeSource" value="API">'; // Add source information
                    echo '<button type="submit" name="addRecipeButton">Add Recipe to Database</button>';
                    echo '</form>';

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

// Handle adding recipe to the database
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addRecipeButton"])) {
    $recipeTitle = isset($_POST["recipeTitle"]) ? trim($_POST["recipeTitle"]) : "";
    $recipeIngredients = isset($_POST["recipeIngredients"]) ? trim($_POST["recipeIngredients"]) : "";
    $recipeServings = isset($_POST["recipeServings"]) ? trim($_POST["recipeServings"]) : "";
    $recipeInstructions = isset($_POST["recipeInstructions"]) ? trim($_POST["recipeInstructions"]) : "";
    $recipeSource = isset($_POST["recipeSource"]) ? trim($_POST["recipeSource"]) : "";

    if (empty($recipeTitle) || empty($recipeIngredients) || empty($recipeServings) || empty($recipeInstructions) || empty($recipeSource)) {
        echo "Please provide all the required data for the recipe.";
    } else {
        // Database connection parameters
        $host = "db.ethereallab.app";
        $username = "jvp9";
        $password = "dgkRX0qbRPKs";
        $database = "jvp9";

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check for duplicate title
        $checkDuplicate = "SELECT * FROM Recipes WHERE title = ?";
        $stmtCheck = $conn->prepare($checkDuplicate);
        $stmtCheck->bind_param("s", $recipeTitle);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            echo "Recipe with the same title already exists!";
        } else {
            // Insert data into the database
            $sql = "INSERT INTO Recipes (title, ingredients, servings, instructions, source) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $recipeTitle, $recipeIngredients, $recipeServings, $recipeInstructions, $recipeSource);

            if ($stmt->execute()) {
                echo "Recipe added to the database successfully!";
            } else {
                echo "Error adding recipe to the database: " . $stmt->error;
            }

            // Close the database connection
            $stmt->close();
        }

        // Close the duplicate check statement and connection
        $stmtCheck->close();
        $conn->close();
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
