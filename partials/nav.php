<?php
require_once(__DIR__ . "/../lib/functions.php");

$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}

$localWorks = true;

if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}

session_start();
?>

<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>

<nav>
    <ul>
        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('home.php'); ?>">Home</a></li>
            <li><a href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
            <li><a href="<?php echo get_url('create_recipe.php'); ?>">Create Recipe</a></li>
            <li><a href="<?php echo get_url('search_recipe_user.php'); ?>">Search Recipes</a></li>
            <li><a href="<?php echo get_url('favorites.php'); ?>">My Favorites</a></li>
        <?php endif; ?>

        <?php if (!is_logged_in()) : ?>
            <li><a href="<?php echo get_url('login.php'); ?>">Login</a></li>
            <li><a href="<?php echo get_url('register.php'); ?>">Register</a></li>
        <?php endif; ?>

        <?php if (has_role("Admin")) : ?>
            <li><a href="<?php echo get_url('my_recipes.php'); ?>">Data List</a></li>
            <li><a href="<?php echo get_url('all_users_association.php'); ?>">All Users Association</a></li>
            <li><a href="<?php echo get_url('not_associated.php'); ?>">No Association Data</a></li>
            <li><a href="<?php echo get_url('admin_associate.php'); ?>">Associate Data</a></li>
            <li><a href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
            <li><a href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
            <li><a href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
        <?php endif; ?>

        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>
