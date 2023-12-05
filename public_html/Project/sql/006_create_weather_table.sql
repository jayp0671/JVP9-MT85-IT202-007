CREATE TABLE weather_data (
    id SERIAL PRIMARY KEY,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    city_name VARCHAR(255) NOT NULL,
    temperature DECIMAL(5, 2),
    humidity DECIMAL(5, 2),
    wind_speed DECIMAL(5, 2),
    weather_description TEXT,
    forecast_date DATE,
    time_zone VARCHAR(50),
    ip_address VARCHAR(15),
    history_date DATE,
    search_query VARCHAR(255),
    future_date DATE
);