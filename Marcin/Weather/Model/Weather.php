<?php

/*
 * CRUD
 * https://www.mageplaza.com/magento-2-module-development/how-to-create-crud-model-magento-2.html
 */

namespace Marcin\Weather\Model;

use Marcin\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Weather extends AbstractModel implements WeatherInterface, IdentityInterface
{
    const CACHE_TAG = 'marcin_weather_weather';
    protected $_cacheTag = 'marcin_weather_weather';
    protected $_eventPrefix = 'marcin_weather_weather';

    protected function _construct()
    {
        $this->_init(ResourceModel\Weather::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function setWeather($weather)
    {
        return $this->setData(self::FIELD_WEATHER, $weather);
    }

    public function getWeather()
    {
        return $this->getData(self::FIELD_WEATHER);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::FIELD_CREATED_AT, $createdAt);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::FIELD_CREATED_AT);
    }
}
