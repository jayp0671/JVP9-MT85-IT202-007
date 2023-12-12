<?php
require(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Home</title>
    <!-- Add your CSS stylesheets or link to a stylesheet file here -->
    <!-- Example: <link rel="stylesheet" href="styles.css"> -->
</head>
<body>

<div>
    <header>
        <h1>Home</h1>
    </header>

    <section>
        <!-- Add some informative content about your website -->
        <p>
        Welcome to the Recipe Website! Whether you're a seasoned chef or a cooking enthusiast, our platform is your culinary companion.
    Discover a world of delightful recipes, create your own culinary masterpieces, and connect with a community that shares your passion for good food.
</p>

<p>
    Explore the features of our platform:
</p>

<ul>
    <li><strong>Home:</strong> Navigate back to the homepage.</li>
    <li><strong>Profile:</strong> View and manage your user profile.</li>
    <li><strong>Create Recipe:</strong> Create and add your own unique recipes.</li>
    <li><strong>Search Recipes:</strong> Explore a diverse collection of recipes based on various criteria.</li>
    <li><strong>My Favorites:</strong> Access a curated list of your saved favorite recipes.</li>
    <li><strong>Logout:</strong> Log out of your account.</li>
</ul>

        
        <!-- Add some dynamic content based on user status -->
        <?php
        if (is_logged_in(true)) {
            echo '<p>Enjoy!</p>';
        } else {
            echo '<p>Sign in to access exclusive features.</p>';
        }
        ?>
    </section>
    
    <section>
        <!-- Add any other sections, features, or content you want to highlight -->
        <!-- <p>Explore our latest articles, products, or services.</p> -->
    </section>
</div>

<!-- Add any additional scripts or JavaScript files here if needed -->

</body>
</html>
