<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class QueueServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {

        $config = $serviceLocator->get('Config');
        
        $queueConfig = $config['queue'];
        
        return new QueueService($queueConfig);

    }

}