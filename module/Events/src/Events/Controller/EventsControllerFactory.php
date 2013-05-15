<?php

namespace Events\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class EventsControllerFactory implements FactoryInterface {

    /**
     * Default method to be used in a Factory Class
     * 
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		
	    // dependency is fetched from Service Manager
	    $eventService = $serviceLocator->getServiceLocator()->get('Events\Service\EventService');
	    
	    // Controller is constructed, dependencies are injected (IoC in action)
	    $controller = new \Events\Controller\EventsController($eventService); 
	    
	    return $controller; 
		
	}

}