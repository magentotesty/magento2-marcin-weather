<?php

/* 
 * Search Criteria
 * https://webkul.com/blog/how-to-use-search-criteria-in-custom-module/
 */

namespace Marcin\Weather\Model;

use Marcin\Weather\Api\WeatherRepositoryInterface;
use Marcin\Weather\Model\ResourceModel\Weather as Resource;
use Marcin\Weather\Api\Data\WeatherInterfaceFactory;
use Marcin\Weather\Api\Data\WeatherSearchResultsInterfaceFactory;
use Marcin\Weather\Api\Data\WeatherInterface;
use Marcin\Weather\Logger\Logger;
use Marcin\Weather\Model\ResourceModel\Weather\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder\Proxy as SearchCriteriaBuilderProxy;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\NoSuchEntityException;

class WeatherRepository implements WeatherRepositoryInterface
{
    protected $resource;

    protected $factory;

    protected $searchResultsFactory;

    protected $logger;

    protected $collectionFactory;

    protected $collectionProcessor;

    protected $searchCriteriaBuilder;

    public function __construct(Resource $resource, WeatherInterfaceFactory $factory, WeatherSearchResultsInterfaceFactory $searchResultsFactory, Logger $logger, CollectionFactory $collectionFactory, CollectionProcessorInterface $collectionProcessor, SearchCriteriaBuilderProxy $searchCriteriaBuilder, SortOrderBuilder $sortOrderBuilder)
    {
        $this->resource = $resource;
        $this->factory = $factory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    public function save(WeatherInterface $weather)
    {
        try {
            $this->resource->save($weather);
        } catch (\Exception $e) {
            $this->logger->info(__CLASS__ . ': ' . $e->getMessage());
            return false;
        }

        return $weather;
    }

    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        $results = $this->searchResultsFactory->create();
        $results->setSearchCriteria($criteria);
        $results->setItems($collection->getItems());
        $results->setTotalCount($collection->getSize());
        return $results;
    }

    public function getLatest()
    {
        $direction = SortOrder::SORT_DESC;
        $field = WeatherInterface::FIELD_CREATED_AT;
        $sortOrder = $this->sortOrderBuilder->setField($field)->setDirection($direction)->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $result = $this->getList($searchCriteria)->getItems();

        return reset($result);
    }

    public function delete(WeatherInterface $weather)
    {
        try {
            $this->resource->delete($weather);
            return true;
        } catch (\Exception $e) {
            $this->logger->info(__CLASS__ . ': ' . self::WEATHER_COULD_NOT_DELETE);
            throw new StateException(sprintf(self::WEATHER_COULD_NOT_DELETE));
        }
    }

    public function deleteById($id)
    {
        $weather = $this->factory->create();
        $this->resource->load($weather, $id);

        if(!$weather->getId()) {
            $this->logger->info(__CLASS__ . ': ' . self::WEATHER_COULD_NOT_DELETE_BY_ID, $id);
            throw new NoSuchEntityException(sprintf(self::WEATHER_COULD_NOT_DELETE_BY_ID, $id));
        }

        return $this->delete($weather);
    }
}
