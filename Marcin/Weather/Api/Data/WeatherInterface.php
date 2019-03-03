<?php

/*
 * CRUD
 * https://www.mageplaza.com/magento-2-module-development/how-to-create-crud-model-magento-2.html
 */

namespace Marcin\Weather\Api\Data;

interface WeatherInterface
{
    const TABLE            = 'marcin_weather';
    const ID               = 'id';
    const FIELD_WEATHER    = 'weather';
    const FIELD_CREATED_AT = 'created_at';

    public function setId($id);

    public function getId();

    public function setWeather($weather);

    public function getWeather();

    public function setCreatedAt($createdAt);

    public function getCreatedAt();
}