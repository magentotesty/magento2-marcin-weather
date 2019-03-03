<?php

/*
 * Logger:
 * https://magento.stackexchange.com/questions/75935/how-to-create-custom-log-file-in-magento-2
 */

namespace Marcin\Weather\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    public $loggerType = Logger::INFO;

    public $fileName = '/var/log/marcin-weather.log';
}
