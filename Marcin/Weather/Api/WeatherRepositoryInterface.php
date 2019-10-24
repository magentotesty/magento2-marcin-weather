<?php

/*
 * Search Criteria
 * https://webkul.com/blog/how-to-use-search-criteria-in-custom-module/
 */

namespace Marcin\Weather\Api;

use Marcin\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface WeatherRepositoryInterface
{
    const WEATHER_COULD_NOT_DELETE = 'Cannot delete weather data.';

    const WEATHER_COULD_NOT_DELETE_BY_ID = 'Cannot delete weather data. Entity id "%s" does not exist.';

    const WEATHER_DELETE_SUCCESS = 'Selected rows have been deleted.';

    public function save(WeatherInterface $model);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function getLatest();
}