<?php

namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class FeedbackControllerFactory implements FactoryInterface {

    /**
     * Default method to be used in a Factory Class
     * 
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		
	    $form = new \Application\Form\Feedback();
	    
	    $formFilter = new \Application\Form\FeedbackFilter();
	    $form->setInputFilter($formFilter);
	    
	    // Controller is constructed, dependencies are injected (IoC in action)
	    $controller = new \Application\Controller\FeedbackController($form); 
	    
	    return $controller; 
		
	}

}