# Marcin-Weather

Custom Weather Widget with API selection (available provider is OpenWeatherMap) for Magento 2.

## Installation

Copy the files to the *app/code/Marcin/Weather* directory (the repository contains *Marcin/Weather* directories).

Run the bash command in your magento root directory:
```bash
bin/magento module:enable Marcin_Weather
composer require "cmfcmf/openweathermap-php-api"
bin/magento setup:upgrade 
```
## Usage for OpenWeatherMap

Register at 'https://openweathermap.org' and copy your ApiKey (*profile/API keys*).

Paste key in */Stores/Configuration/Marcin Modules/Weather Marcin Module/API Settings/Api Key* field.

Put your widget in the chosen place :)

