<?php

namespace Events\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RightSideBarFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator) {
		
	    $service = $serviceLocator->getServiceLocator()->get('Events\Service\EventService');
	    $request = $serviceLocator->getServiceLocator()->get('Request');
	    	    
	    return new RightSideBar();
		
	}

}