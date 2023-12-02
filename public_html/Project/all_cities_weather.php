<?php
require_once(__DIR__ . "/../../partials/nav.php");
ini_set('max_execution_time', 300); // Set the maximum execution time to 300 seconds (adjust as needed)

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numCities = (int)$_POST["num_cities"];
    $sortOption = $_POST["sort_option"] ?? "normal";
    $userEnteredCity = $_POST["user_city"] ?? "";

    if ($numCities >= 1 && $numCities <= 100) {
        $cityNames = [
            "Tokyo", "Delhi", "Shanghai", "Sao Paulo", "Mexico City", "Cairo", "Mumbai", "Beijing", "Dhaka", "Osaka",
            "New York", "Karachi", "Buenos Aires", "Chongqing", "Istanbul", "Kolkata", "Manila", "Lagos", "Rio de Janeiro",
            "Tianjin", "Kinshasa", "Guangzhou", "Los Angeles", "Moscow", "Shenzhen", "Lahore", "Bangalore", "Paris", "Bogota",
            "Jakarta", "Chennai", "Lima", "Bangkok", "Seoul", "Nagoya", "Hyderabad", "London", "Tehran", "Chicago", "Chengdu",
            "Nanjing", "Wuhan", "Ho Chi Minh City", "Luanda", "Ahmedabad", "Kuala Lumpur", "Xian", "Hong Kong", "Dongguan",
            "Hangzhou", "Foshan", "Shenyang", "Riyadh", "Baghdad", "Santiago", "Surat", "Madrid", "Suzhou", "Pune", "Harbin",
            "Houston", "Dallas", "Toronto", "Dar es Salaam", "Miami", "Belo Horizonte", "Singapore", "Philadelphia", "Atlanta",
            "Fukuoka", "Khartoum", "Barcelona", "Johannesburg", "Saint Petersburg", "Qingdao", "Dalian", "Washington", "Yangon",
            "Alexandria", "Jinan", "Guadalajara", "San Francisco", "Seattle", "Dallas", "Austin", "Phoenix", "San Antonio",
            "Portland", "Denver", "Jacksonville", "Columbus", "Newark", "Fort Worth", "Sydney", "Amsterdam", "Guadalupe", "Pisa",
            "Athens", "Rome", "Bharuch"
        ];

        // Add the user-entered city to the list
        if (!empty($userEnteredCity)) {
            $cityNames[] = $userEnteredCity;
        }

        // Fetch weather information for the selected number of cities
        $weatherData = [];
        $citiesProcessed = 0;
        foreach ($cityNames as $city) {
            $url = "https://weatherapi-com.p.rapidapi.com/current.json?q=" . urlencode($city);
            $cityWeather = makeApiRequest($url);
            
            if ($cityWeather) {
                $weatherData[$city] = $cityWeather;
                $citiesProcessed++;

                if ($citiesProcessed >= $numCities) {
                    break;  // Stop processing once the desired number of cities is reached
                }
            }
        }

        // Sort the weather data based on the selected option
        switch ($sortOption) {
            case "alphabetical":
                ksort($weatherData);
                break;
            case "temp_high_low":
                uasort($weatherData, function ($a, $b) {
                    return $b['current']['temp_f'] - $a['current']['temp_f'];
                });
                break;
            case "temp_low_high":
                uasort($weatherData, function ($a, $b) {
                    return $a['current']['temp_f'] - $b['current']['temp_f'];
                });
                break;
            case "humidity_high_low":
                uasort($weatherData, function ($a, $b) {
                    return $b['current']['humidity'] - $a['current']['humidity'];
                });
                break;
            case "humidity_low_high":
                uasort($weatherData, function ($a, $b) {
                    return $a['current']['humidity'] - $b['current']['humidity'];
                });
                break;
            case "wind_speed_high_low":
                uasort($weatherData, function ($a, $b) {
                    return $b['current']['wind_mph'] - $a['current']['wind_mph'];
                });
                break;
            case "wind_speed_low_high":
                uasort($weatherData, function ($a, $b) {
                    return $a['current']['wind_mph'] - $b['current']['wind_mph'];
                });
                break;
            // For "normal" or default case, do nothing (already in the order fetched)
            default:
                break;
        }

        // Display the weather information for the selected cities
        if (!empty($weatherData)) {
            echo "<table class='weather-table'>";
            echo "<tr><th>City</th><th>Temperature (°F)</th><th>Humidity (%)</th><th>Wind Speed (mph)</th></tr>";

            foreach ($weatherData as $city => $data) {
                echo "<tr>";
                echo "<td>$city</td>";
                echo "<td>{$data['current']['temp_f']}</td>";
                echo "<td>{$data['current']['humidity']}</td>";
                echo "<td>{$data['current']['wind_mph']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No weather data available for the selected cities.</p>";
        }
    } else {
        echo "<p>Please enter a valid number between 1 and 100.</p>";
    }
}
?>

<!-- Display the form for the user to input the number of cities, sorting option, and user-entered city -->
<form action="all_cities_weather.php" method="post">
    <label for="num_cities">Select the number of cities (1-100):</label>
    <input type="number" id="num_cities" name="num_cities" min="1" max="100" required>

    <label for="user_city">Enter a city name:</label>
    <input type="text" id="user_city" name="user_city">

    <label for="sort_option">Sort by:</label>
    <select id="sort_option" name="sort_option">
        <option value="normal" selected>Normal</option>
        <option value="alphabetical">Alphabetical</option>
        <option value="temp_high_low">Highest - Lowest Temperature</option>
        <option value="temp_low_high">Lowest - Highest Temperature</option>
        <option value="humidity_high_low">Highest - Lowest Humidity</option>
        <option value="humidity_low_high">Lowest - Highest Humidity</option>
        <option value="wind_speed_high_low">Highest - Lowest Wind Speed</option>
        <option value="wind_speed_low_high">Lowest - Highest Wind Speed</option>
    </select>

    <button type="submit">Get Weather Information</button>
</form>
