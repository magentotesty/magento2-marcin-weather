<?php

/*
 * CRUD
 * https://www.mageplaza.com/magento-2-module-development/how-to-create-crud-model-magento-2.html
 */

namespace Marcin\Weather\Model\ResourceModel\Weather;

use Marcin\Weather\Model;
use Marcin\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = WeatherInterface::ID;

    protected function _construct()
    {
        $this->_init(Model\Weather::class, Model\ResourceModel\Weather::class);
    }
}
