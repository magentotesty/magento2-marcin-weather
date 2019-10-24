<?php

namespace Marcin\Weather\Model\ResourceModel\Weather\Grid;


use Marcin\Weather\Model\ResourceModel\Weather;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public function __construct(EntityFactory $entityFactory, Logger $logger, FetchStrategy $fetchStrategy, EventManager $eventManager)
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, 'marcin_weather', Weather::class);
    }

    public function getItems(): array
    {

        $items = parent::getItems();

        foreach ($items as $item) {
            $data = $item->getData();
            $item->setData($data);
        }

        return $items;
    }

}

