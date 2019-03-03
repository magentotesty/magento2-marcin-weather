<?php

namespace Marcin\Weather\Model\Api\Providers;

use Marcin\Weather\Logger\Logger;
use Marcin\Weather\Helper\Config;
use Cmfcmf\OpenWeatherMap as CmfOpenWeatherMap;
use Cmfcmf\OpenWeatherMap\CurrentWeather;

class OpenWeatherMap extends AbstractProvider
{
    protected $client;
    protected $logger;

    public function __construct(CmfOpenWeatherMap $client, Logger $logger, Config $config)
    {
        $this->client = $client;
        $this->logger = $logger;
        parent::__construct($config);
    }

    public function getWeather(string $city)
    {
        $providerStatus = $this->init();
        if (!$providerStatus) {
            $this->logger->info($this->setLogMessageWithClass(self::WEATHER_PROVIDER_NOT_FOUND));
            return;
        }

        $apiKey = $this->config->getOpenWeatherMapApiKey();
        $this->client->setApiKey($apiKey);

        $weather = $this->client->getWeather($city);
        if (!$weather->city->id) {
            $this->logger->info($this->setLogMessageWithClass(self::WEATHER_PROVIDER_CITY_NOT_FOUND));
            return;
        }

        return $this->parseWeather($weather);
    }

    protected function parseWeather(CurrentWeather $weather)
    {
        if (!$weather) {
            $this->logger->info($this->setLogMessageWithClass(self::WEATHER_WEATHER_NOT_FOUND_OPEN_WEATHER_MAP));
            return;
        }

        $parsedWeather =
            ' temperature: ' . $weather->temperature->now .
            ' | weather: ' . $weather->weather->description .
            ' | pressure: ' . $weather->pressure .
            ' | wind speed: ' . $weather->wind->speed;

        return $parsedWeather;
    }

    private function setLogMessageWithClass(string $log)
    {
        return __CLASS__ . ': ' . $log;
    }
}
