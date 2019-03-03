<?php

namespace Marcin\Weather\Model\Api\Providers;

use Marcin\Weather\Helper\Config;
use Marcin\Weather\Api\WeatherProvidersInterface;

abstract class AbstractProvider implements WeatherProvidersInterface
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function init()
    {
        if ($this->config->isWeatherModuleEnabled()) {
            return true;
        }
        return false;
    }

    abstract public function getWeather(string $city);
}