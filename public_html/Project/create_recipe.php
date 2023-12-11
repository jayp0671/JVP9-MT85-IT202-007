<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Replace with the actual path to your style.css -->
    <style>
        /* Updated styles based on your website's color scheme */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #87CEEB; /* Light Blue - Match your website's background color */
            color: #00008b; /* Dark Blue - Match your website's text color */
        }

        form {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #336699; /* Dark Blue - Match your website's navigation bar color */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none; /* Remove underlining */
            display: inline-block; /* Align inline with the submit button */
            margin-right: 0px; /* Add some space between the buttons */
            width: 97px; /* Set a fixed width for both buttons */
            flex-shrink: 0; /* Prevent buttons from shrinking */
            font-size: 14px; /* Adjust font size to fit within the fixed width */
        }
    </style>
</head>

<body>
    <form action="create_recipe.php" method="post">
        <h2>Create a New Recipe</h2>

        <!-- Add other form fields as needed -->

        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="ingredients">Ingredients:</label>
        <textarea name="ingredients" rows="4" required></textarea>

        <label for="instructions">Instructions:</label>
        <textarea name="instructions" rows="4" required></textarea>

        <label for="servings">Servings:</label>
        <input type="number" name="servings" required min="1">

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
        <button type="button" id="homeButton" class="button">Home</button>
        <!-- <a href="home.php" class=".button">Home</a> -->
        <!-- <button type="button">Click me</button> -->

        <!-- Display the completion message within the form -->
        <div id="completionMessage" style="margin-top: 10px;"></div>
    </form>

    <script>
        document.getElementById('homeButton').addEventListener('click', function () {
            window.location.href = 'home.php';
        });
    </script>

    <?php
    session_start();
    // PHP code to process the form will go here

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Validate form data (you can add more validation as needed)
        $title = trim($_POST["title"]);
        $ingredients = trim($_POST["ingredients"]);
        $instructions = trim($_POST["instructions"]);
        $servings = intval($_POST["servings"]);
    
        // Validate data
        if (empty($title) || empty($ingredients) || empty($instructions) || $servings <= 0) {
            echo '<script>document.getElementById("completionMessage").innerHTML = "Please fill in all fields with valid data.";</script>';
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
            $stmtCheck->bind_param("s", $title);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
    
            if ($resultCheck->num_rows > 0) {
                echo '<script>document.getElementById("completionMessage").innerHTML = "Recipe with the same title already exists!";</script>';
            } else {
                // Insert data into the database
                $sql = "INSERT INTO Recipes (title, ingredients, instructions, servings, source, user_id) VALUES (?, ?, ?, ?, ?, ?)";
                $source = "Manual"; // Set the source to "Manual"
                
                // Assuming you have a user session
                $user_id = isset($_SESSION["user"]["id"]) ? $_SESSION["user"]["id"] : null;
    
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssisi", $title, $ingredients, $instructions, $servings, $source, $user_id);
    
                if ($stmt->execute()) {
                    echo '<script>document.getElementById("completionMessage").innerHTML = "Recipe created successfully!";</script>';
                } else {
                    echo '<script>document.getElementById("completionMessage").innerHTML = "Error creating recipe: ' . $stmt->error . '";</script>';
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

</body>

</html>
