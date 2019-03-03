<?php

namespace Marcin\Weather\Api;

interface WeatherProvidersInterface 
{
    const WEATHER_MODULE_NOT_ENABLED = 'Weather module not enabled';
    const WEATHER_CRON_NOT_ENABLED  = 'Weather CRON not enabled';
    const WEATHER_PROVIDER_NOT_FOUND = 'Weather provider not found';
    const WEATHER_PROVIDER_CITY_NOT_FOUND = 'City not found';
    const WEATHER_PROVIDER_OPEN_WEATHER_MAP = 'open_weather_map';
    const WEATHER_WEATHER_NOT_FOUND_OPEN_WEATHER_MAP = 'Open Weather Map: Weather not found';
    const WEATHER_AUTOLOAD_FILE_NOT_FOUND_OPEN_WEATHER_MAP = 'Open Weather Map: Autoload file not found';

    public function getWeather(string $city);
}