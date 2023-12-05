<?php
session_start();

require(__DIR__ . "/../../partials/nav.php");

function makeApiRequest($url) {
    $apiKey = '90cef3f2d3msh5a039e04edfd513p15fe53jsn5e8c9c175f86';

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,

        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: weatherapi-com.p.rapidapi.com",
            "X-RapidAPI-Key: " . $apiKey
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        flash("cURL Error #:" . $err);
        return false;
    } else {
        return json_decode($response, true);
    }
}

$city = sanitize_city_name($_POST['city']);
$radio = $_POST['info_radio'] ?? '';

if (empty($city) || empty($radio)) {
    flash("Invalid request. Please enter a city and select an option.");
    header("Location: request_data_form.php");
    exit;
}

$_SESSION['weather_data']['selected_radio'] = $radio;
//echo "<p>Selected Radio: $radio</p>";  // Debug statement

// Make API request based on selected radio button
$url = '';
switch ($radio) {
    case 'currentWeather':
        $url = "https://weatherapi-com.p.rapidapi.com/current.json?q=" . urlencode($city);
        break;
    case 'forecastWeather':
        $url = "https://weatherapi-com.p.rapidapi.com/forecast.json?q=" . urlencode($city) . "&days=4";
        break;
    case 'timeZone':
        $url = "https://weatherapi-com.p.rapidapi.com/timezone.json?q=" . urlencode($city);
        break;
    case 'astronomy':
        $url = "https://weatherapi-com.p.rapidapi.com/astronomy.json?q=" . urlencode($city);
        break;
    // case 'sports':
    //     $url = "https://weatherapi-com.p.rapidapi.com/sports.json?q=" . urlencode($city);
    //     break;
}

if ($url) {
    $weatherData = makeApiRequest($url);

    if ($weatherData) {
        $_SESSION['weather_data'][$radio] = $weatherData;
    } else {
        flash("Unable to get $radio data.");
    }
}

header("Location: weather_result.php");
exit;
?>
