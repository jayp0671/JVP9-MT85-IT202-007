<?php
session_start();

require(__DIR__ . "/../../partials/nav.php");

// Check if 'weather_data' key exists in $_SESSION
if (isset($_SESSION['weather_data'])) {
    $cityName = $_SESSION['weather_data']['currentWeather']['location']['name'];

    echo "<h2>Weather Data for $cityName</h2>";

    // Check which radio button was selected
    $radio = $_SESSION['weather_data']['selected_radio'] ?? '';
    //echo "<p>Selected Radio: $radio</p>";  // Debug statement

    switch ($radio) {
        case 'currentWeather':
            displayCurrentWeather($_SESSION['weather_data']['currentWeather']['current']);
            break;
        case 'forecastWeather':
            displayForecastWeather($_SESSION['weather_data']['forecastWeather']['forecast']['forecastday']);
            break;
        case 'timeZone':
            displayTimeZone($_SESSION['weather_data']['timeZone']['location']);
            break;
        case 'astronomy':
            displayAstronomy($_SESSION['weather_data']['astronomy']['astronomy']);
            break;
        // case 'sports':
        //     displaySports($_SESSION['weather_data']['sports']['football']);
        //     break;
        default:
            echo "<p>No matching radio button found.</p>";  // Debug statement
    }
} else {
    flash("No weather data available. Please submit the form to get weather information.");
    header("Location: request_data_form.php");
    exit;
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





// Function to display sports

?>
