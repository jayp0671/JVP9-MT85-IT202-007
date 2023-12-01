<?php
require_once(__DIR__ . "/../../partials/nav.php");
?>

<h1>Weather Information Request</h1>

<?php require(__DIR__ . "/../../partials/flash.php"); ?>

<form action="weather_info_handler.php" method="post">
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>
    <br>

    <fieldset>
        <legend>Select Information:</legend>

        <div>
            <input type="radio" id="currentWeather" name="info_radio" value="currentWeather" required>
            <label for="currentWeather">Current Weather</label>
        </div>

        <div>
            <input type="radio" id="forecastWeather" name="info_radio" value="forecastWeather" required>
            <label for="forecastWeather">Weather Forecast</label>
        </div>

        <div>
            <input type="radio" id="timeZone" name="info_radio" value="timeZone" required>
            <label for="timeZone">Time Zone</label>
        </div>

        <div>
            <input type="radio" id="astronomy" name="info_radio" value="astronomy" required>
            <label for="astronomy">Astronomy</label>
        </div>

        <!-- <div>
            <input type="radio" id="sports" name="info_radio" value="sports" required>
            <label for="sports">Sports</label>
        </div> -->
        
    </fieldset>

    <br>

    <button type="submit">Get Weather Information</button>
</form>
