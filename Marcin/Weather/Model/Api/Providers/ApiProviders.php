<?php

/*
 * Drop-down list
 * https://magento.stackexchange.com/questions/151862/magento-2-drop-down-select-list-for-custom-magento-system-configuration-sectio
 */

namespace Marcin\Weather\Model\Api\Providers;

use Magento\Framework\Option\ArrayInterface;

class ApiProviders implements ArrayInterface
{
    protected $values = [];
    protected $providers = [
        'open_weather_map'
    ];

    public function toOptionArray()
    {
        foreach ($this->providers as $provider) {
            $this->values[] = [
                'value' => $provider,
                'label' => ucwords(str_replace('_', ' ', $provider))
            ];
        }
        return $this->values;
    }
}
