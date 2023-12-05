<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<h1>Home</h1>

<?php
if (is_logged_in(true)) {
    // Comment this out if you don't want to see the session variables
    error_log("Session data: " . var_export($_SESSION, true));
}
?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>

<!-- Weather Display Section -->
<div>
    <h2>Current Weather</h2>

    <?php
    $rapidApiKey = '90cef3f2d3msh5a039e04edfd513p15fe53jsn5e8c9c175f86'; // Replace with your API key
    $city = 'New York'; // You can change the city as needed

    $apiUrl = "https://weatherapi-com.p.rapidapi.com/current.json?q=$city";

    $options = [
        "http" => [
            "header" => "X-RapidAPI-Key: $rapidApiKey"
        ]
    ];

    $context = stream_context_create($options);
    $weatherData = file_get_contents($apiUrl, false, $context);

    if ($weatherData) {
        $weather = json_decode($weatherData, true);
        echo "<p>City: " . $weather['location']['name'] . "</p>";
        echo "<p>Temperature: " . $weather['current']['temp_c'] . " °C</p>";
        echo "<p>Humidity: " . $weather['current']['humidity'] . "%</p>";
        echo "<p>Wind Speed: " . $weather['current']['wind_kph'] . " km/h</p>";
        // Display other weather information as needed
    } else {
        echo "<p>Unable to fetch current weather data.</p>";
    }
    ?>
</div>
