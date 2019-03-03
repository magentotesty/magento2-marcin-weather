<?php

/*
 * Search Criteria
 * https://webkul.com/blog/how-to-use-search-criteria-in-custom-module/
 */

namespace Marcin\Weather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface WeatherSearchResultsInterface extends SearchResultsInterface
{
    public function getItems();

    public function setItems(array $items);
}