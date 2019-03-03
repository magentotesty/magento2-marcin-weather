<?php

/*
 * CRUD
 * https://www.mageplaza.com/magento-2-module-development/how-to-create-crud-model-magento-2.html
 */

namespace Marcin\Weather\Model\ResourceModel;

use Marcin\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Weather extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(WeatherInterface::TABLE, WeatherInterface::ID);
    }
}
