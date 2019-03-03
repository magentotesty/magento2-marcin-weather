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
    public function save(WeatherInterface $model);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function getLatest();
}