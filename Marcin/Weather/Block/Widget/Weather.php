<?php

/*
 * Block, Template
 * https://www.mageplaza.com/magento-2-module-development/view-block-layout-template-magento-2.html
 */

namespace Marcin\Weather\Block\Widget;

use Marcin\Weather\Api\WeatherRepositoryInterface;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template;

class Weather extends Template implements BlockInterface
{
    protected $_template = 'widget/weather.phtml';
    protected $weatherRepository;

    public function __construct(WeatherRepositoryInterface $weatherRepository, Template\Context $context)
    {
        $this->weatherRepository = $weatherRepository;
        parent::__construct($context);
    }

    public function getWidgetTitle()
    {
        return $this->getData('marcin_weather_widget_title');
    }

    public function getContent()
    {
        return $this->weatherRepository->getLatest()->getWeather();
    }
}
