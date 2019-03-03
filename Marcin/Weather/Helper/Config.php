<?php

namespace Marcin\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Config extends AbstractHelper
{
    public function isWeatherModuleEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag('weather/general/enable');
    }

    public function isWeatherCronEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag('weather/general/cron_enable');
    }

    public function getApiProvider(): string
    {
        return (string) $this->scopeConfig->getValue('weather/api/provider');
    }

    public function getCity(): string
    {
        return (string) $this->scopeConfig->getValue('weather/api/city');
    }

    public function getOpenWeatherMapApiKey(): string
    {
        return (string) $this->scopeConfig->getValue('weather/api/api_key');
    }
}