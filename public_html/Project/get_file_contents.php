<?php

$api_url = "https://recipe-by-api-ninjas.p.rapidapi.com/v1/recipe?query=italian%20wedding%20soup";

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
    echo "Error fetching recipe data";
} else {
    // Output the response
    echo $response;
}
?>
