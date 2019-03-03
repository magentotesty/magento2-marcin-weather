<?php

namespace Marcin\Weather\Model\Api;

use Marcin\Weather\Helper\Config;
use Marcin\Weather\Logger\Logger;
use Marcin\Weather\Api\WeatherProvidersInterface;
use Marcin\Weather\Model\Api\Providers\OpenWeatherMapFactory;

class ApiConnection implements WeatherProvidersInterface
{
    protected $config;
    protected $logger;
    protected $openWeatherMapFactory;

    public function __construct(Config $config,  Logger $logger, OpenWeatherMapFactory $openWeatherMapFactory)
    {
        $this->config = $config;
        $this->logger = $logger;
        $this->openWeatherMapFactory = $openWeatherMapFactory;
    }

    public function getWeather(string $city)
    {
        $client = $this->getApiClient();
        if(!$client) {
            $this->logger->info(__CLASS__ . ': '  . self::WEATHER_PROVIDER_NOT_FOUND);
            return;
        }
        return $client->getWeather($city);
    }

    protected function getApiClient()
    {
        switch ($this->config->getApiProvider()) {
            case WeatherProvidersInterface::WEATHER_PROVIDER_OPEN_WEATHER_MAP:
                return $this->openWeatherMapFactory->create();
                break;
            default:
                return false;
        }
    }
}
