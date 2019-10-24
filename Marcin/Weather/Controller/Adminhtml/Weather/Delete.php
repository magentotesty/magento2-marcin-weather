<?php

namespace Marcin\Weather\Controller\Adminhtml\Weather;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Marcin\Weather\Model\WeatherRepositoryFactory;

class Delete extends Action
{
    private $weatherRepository;

    protected $messageManager;

    public function __construct(Context $context, WeatherRepositoryFactory $weatherRepositoryFactory, ManagerInterface $messageManager)
    {
        $this->weatherRepository = $weatherRepositoryFactory->create();
        parent::__construct($context);
    }

    public function execute()
    {
        $weatherDataIds = $this->getRequest()->getPostValue()['selected'];

        foreach ($weatherDataIds as $id) {
           try {
               $this->weatherRepository->deleteById($id);
         } catch (\Exception  $e) {
             $this->messageManager->addErrorMessage(sprintf($this->weatherRepository::WEATHER_COULD_NOT_DELETE_BY_ID, $id));
           }
        }

        $this->messageManager->addSuccessMessage($this->weatherRepository::WEATHER_DELETE_SUCCESS);
        return $this->_redirect('admin_weather/weather/index');
    }
}