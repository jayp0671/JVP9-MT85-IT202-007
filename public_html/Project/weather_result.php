<?php
session_start();

require(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/db.php"); // Assuming you have a file with database configuration

// Check if 'weather_data' key exists in $_SESSION
if (isset($_SESSION['weather_data'])) {
    $cityName = $_SESSION['weather_data']['currentWeather']['location']['name'];

    echo "<h2>Weather Data for $cityName</h2>";

    // Check which radio button was selected
    $radio = $_SESSION['weather_data']['selected_radio'] ?? '';

    // Create an array to store weather data for insertion
    $weatherDataForInsert = [];

    switch ($radio) {
        case 'currentWeather':
            $weatherDataForInsert = getCurrentWeatherDataForInsert($_SESSION['weather_data']['currentWeather']['current']);
            displayCurrentWeather($_SESSION['weather_data']['currentWeather']['current']);
            break;
        case 'forecastWeather':
            displayForecastWeather($_SESSION['weather_data']['forecastWeather']['forecast']['forecastday']);
            // Implement logic for forecast weather data insertion
            break;
        case 'timeZone':
            $weatherDataForInsert = getTimeZoneDataForInsert($_SESSION['weather_data']['timeZone']['location']);
            displayTimeZone($_SESSION['weather_data']['timeZone']['location']);
            break;
        case 'astronomy':
            $weatherDataForInsert = getAstronomyDataForInsert($_SESSION['weather_data']['astronomy']['astronomy']);
            displayAstronomy($_SESSION['weather_data']['astronomy']['astronomy']);
            break;
        default:
            echo "<p>No matching radio button found.</p>";
    }

    // Insert weather data into the database
    if (!empty($weatherDataForInsert)) {
        insertWeatherData($weatherDataForInsert);
    }

} else {
    flash("No weather data available. Please submit the form to get weather information.");
    header("Location: request_data_form.php");
    exit;
}

// Function to get current weather data for insertion
function getCurrentWeatherDataForInsert($data)
{
    global $cityName; // Make $cityName global

    return [
        'temperature' => $data['temp_f'],
        'feels_like' => $data['feelslike_f'],
        'wind_speed' => $data['wind_mph'],
        'gust_speed' => $data['gust_mph'],
        'wind_degree' => $data['wind_degree'],
        'wind_direction' => $data['wind_dir'],
        'pressure' => $data['pressure_in'],
        'humidity' => $data['humidity'],
        'cloud' => $data['cloud'],
        'weather_condition' => '', // Set this based on your data
        'city_name' => $cityName,
        // Add other fields as needed
    ];
}

// Function to get time zone data for insertion
function getTimeZoneDataForInsert($data)
{
    global $cityName; // Make $cityName global

    return [
        'city_name' => $cityName,
        'region' => $data['region'],
        'country' => $data['country'],
        'latitude' => $data['lat'],
        'longitude' => $data['lon'],
        'time_zone_id' => $data['tz_id'],
        'local_time' => $data['localtime'],
        // Add other fields as needed
    ];
}

// Function to get astronomy data for insertion
function getAstronomyDataForInsert($data)
{
    global $cityName; // Make $cityName global

    return [
        'city_name' => $cityName,
        'sunrise' => $data['sunrise'],
        'sunset' => $data['sunset'],
        'moonrise' => $data['moonrise'],
        'moonset' => $data['moonset'],
        'moon_phase' => $data['moon_phase'],
        'moon_illumination' => $data['moon_illumination'],
        // Add other fields as needed
    ];
}

// Function to insert weather data into the database
function insertWeatherData($data)
{
    global $db; // Assuming you have a database connection variable

    // Use prepared statements to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO weather_data (temperature, feels_like, wind_speed, gust_speed, wind_degree, wind_direction, pressure, humidity, cloud, weather_condition, city_name, region, country, latitude, longitude, time_zone_id, local_time, sunrise, sunset, moonrise, moonset, moon_phase, moon_illumination) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo "<p>Database error: Unable to prepare statement.</p>";
        return;
    }

    // Bind parameters
    $stmt->bind_param(
        "dddddsdddsdssddssssds",
        $data['temperature'],
        $data['feels_like'],
        $data['wind_speed'],
        $data['gust_speed'],
        $data['wind_degree'],
        $data['wind_direction'],
        $data['pressure'],
        $data['humidity'],
        $data['cloud'],
        $data['weather_condition'],
        $data['city_name'],
        $data['region'],
        $data['country'],
        $data['latitude'],
        $data['longitude'],
        $data['time_zone_id'],
        $data['local_time'],
        $data['sunrise'],
        $data['sunset'],
        $data['moonrise'],
        $data['moonset'],
        $data['moon_phase'],
        $data['moon_illumination']
    );

    // Execute statement
    $stmt->execute();

    // Check for errors
    if ($stmt->errno) {
        echo "<p>Database error: " . $stmt->error . "</p>";
    }

    // Close statement
    $stmt->close();
}

// Function to display current weather
// Function to display current weather
// Function to display current weather
function displayCurrentWeather($data)
{
    echo "<div class='weather-card'>";
    echo "<h3>Current Weather:</h3>";

    echo "<table class='weather-table'>";
    echo "<tr><th>Weather Characteristic</th><th>Data</th></tr>";
    // echo "<tr><td>Local Time:</td><td>{$data['last_updated']}</td></tr>";
    echo "<tr><td>Temperature:</td><td>{$data['temp_f']} °F</td></tr>";
    echo "<tr><td>Feels Like:</td><td>{$data['feelslike_f']} °F</td></tr>";
    echo "<tr><td>Wind Speed:</td><td>{$data['wind_mph']} mph</td></tr>";
    echo "<tr><td>Gust:</td><td>{$data['gust_mph']} mph</td></tr>";
    echo "<tr><td>Wind Degree:</td><td>{$data['wind_degree']}</td></tr>";
    echo "<tr><td>Wind Direction:</td><td>{$data['wind_dir']}</td></tr>";
    echo "<tr><td>Pressure:</td><td>{$data['pressure_in']} in</td></tr>";
    echo "<tr><td>Humidity:</td><td>{$data['humidity']} %</td></tr>";
    echo "<tr><td>Cloud:</td><td>{$data['cloud']} %</td></tr>";
    echo "</table>";

    echo "</div>";
}


// Function to display forecast weather
// Function to display forecast weather
// Function to display forecast weather
function displayForecastWeather($data)
{
    echo "<h3>Weather Forecast:</h3>";

    if (isset($data[0]['date'])) {
        foreach ($data as $forecastDay) {
            echo "<h4>{$forecastDay['date']}</h4>";

            echo "<table class='weather-table'>";
            echo "<tr><th>Time</th><th>Temperature (°F)</th><th>Condition</th><th>Wind Speed (mph)</th><th>Humidity (%)</th></tr>";

            foreach ($forecastDay['hour'] as $hour) {
                echo "<tr>";
                echo "<td>{$hour['time']}</td>";
                echo "<td>{$hour['temp_f']}</td>";
                echo "<td>{$hour['condition']['text']}</td>";
                echo "<td>{$hour['wind_mph']}</td>";
                echo "<td>{$hour['humidity']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    } else {
        echo "<p>Forecast data not available</p>";
    }
}

// Function to display time zone
// Inside your displayTimeZone function
function displayTimeZone($data)
{
    
    echo "<div class='weather-card'>";
    echo "<h3>Time Zone:</h3>";
    echo "<table class='weather-table'>";
    echo "<tr><th>Time Zone Characteristic</th><th>Data</th></tr>";
    echo "<tr><td>Name</td><td>{$data['name']}</td></tr>";
    echo "<tr><td>Region</td><td>{$data['region']}</td></tr>";
    echo "<tr><td>Country</td><td>{$data['country']}</td></tr>";
    echo "<tr><td>Latitude</td><td>{$data['lat']}</td></tr>";
    echo "<tr><td>Longitude</td><td>{$data['lon']}</td></tr>";
    echo "<tr><td>Time Zone ID</td><td>{$data['tz_id']}</td></tr>";
    echo "<tr><td>Local Time</td><td>{$data['localtime']}</td></tr>";
    echo "</table>";
}


// Function to display astronomy
// Function to display astronomy
function displayAstronomy($data)
{
    echo "<div class='weather-card'>";
    echo "<h3>Astronomy:</h3>";

    if (isset($data['astro'])) {
        $astroData = $data['astro'];

        echo "<table class='weather-table'>";
        echo "<tr><th>Attribute</th><th>Value</th></tr>";
        echo "<tr><td>Sunrise</td><td>{$astroData['sunrise']}</td></tr>";
        echo "<tr><td>Sunset</td><td>{$astroData['sunset']}</td></tr>";
        echo "<tr><td>Moonrise</td><td>{$astroData['moonrise']}</td></tr>";
        echo "<tr><td>Moonset</td><td>{$astroData['moonset']}</td></tr>";
        echo "<tr><td>Moon Phase</td><td>{$astroData['moon_phase']}</td></tr>";
        echo "<tr><td>Moon Illumination</td><td>{$astroData['moon_illumination']}%</td></tr>";
        echo "</table>";
    } else {
        echo "<p>Astronomy data not available</p>";
    }
}
?>
