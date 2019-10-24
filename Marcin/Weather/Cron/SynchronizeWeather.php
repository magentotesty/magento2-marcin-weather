<?php

namespace Marcin\Weather\Cron;

use Marcin\Weather\Helper\Config;
use Marcin\Weather\Model\Api\ApiConnection;
use Marcin\Weather\Logger\Logger;
use Marcin\Weather\Api\WeatherRepositoryInterface;
use Marcin\Weather\Api\Data\WeatherInterfaceFactory;
use Marcin\Weather\Api\WeatherProvidersInterface;

class SynchronizeWeather
{
    protected $config;

    protected $ApiConnection;

    protected $logger;

    protected $weatherRepository;

    protected $weatherFactory;

    public function __construct(Config $config, ApiConnection $ApiConnection, Logger $logger, WeatherRepositoryInterface $weatherRepository, WeatherInterfaceFactory $weatherFactory)
    {
        $this->config = $config;
        $this->ApiConnection = $ApiConnection;
        $this->logger = $logger;
        $this->weatherRepository = $weatherRepository;
        $this->weatherFactory = $weatherFactory;
    }

    public function synchronize()
    {
        if (!$this->config->isWeatherModuleEnabled()) {
            $this->logger->info($this->setLogMessageWithClass(WeatherProvidersInterface::WEATHER_MODULE_NOT_ENABLED));
            return;
        } elseif (!$this->config->isWeatherCronEnabled()) {
            $this->logger->info($this->setLogMessageWithClass(WeatherProvidersInterface::WEATHER_CRON_NOT_ENABLED));
            return;
        }

        try {


            $city = $this->config->getCity();

            $weather = $this->ApiConnection->getWeather($city);

            $weatherModel = $this->weatherFactory->create();
            $weatherModel->setWeather($weather);

            $this->weatherRepository->save($weatherModel);
        } catch (\Exception $e) {
            $this->logger->info($this->setLogMessageWithClass($e->getMessage()));
        }
    }

    protected function setLogMessageWithClass(string $log)
    {
        return __CLASS__ . ': ' . $log;
    }
}