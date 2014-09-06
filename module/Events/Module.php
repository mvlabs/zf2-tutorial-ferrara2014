<?php

namespace Events;

use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements ViewHelperProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    
    // Service Manager Configuration
    public function getServiceConfig() {
    	return array(
    			'factories' => array(
  					'Events\Service\EventService' => 'Events\Service\EventServiceFactory',
                    
                    /*
                     * Two mappers are available: one for Zend\Db and one for Doctrine.
                     * Now we use the latter, but you could easily switch to the first if needed
                     */
                    //'Events\Mapper\EventMapper' => 'Events\Mapper\ZendDbEventMapperFactory',
                    'Events\Mapper\EventMapper' => 'Events\Mapper\DoctrineEventMapperFactory',
    			),
    			
    	);
    }
    
    public function getControllerConfig() {
        
        return array(
            'factories' => array(
                'Events\Controller\Events' => 'Events\Controller\EventsControllerFactory',
            ),
            'invokables' => array(
                'Events\Controller\Admin'  => 'Events\Controller\AdminController',
            ),
        );
        
    } 
    
    
    public function getControllerPluginConfig()
    {
    	return array(
    		'invokables' => array(
    		    'getAndCheckNumericParam' => 'Events\Controller\Plugin\GetAndCheckNumericParam',
    		)
    	);
    }
    
    
    public function getViewHelperConfig()
    {
    	return array(
			'invokables' => array( 
			    'cost' => 'Events\View\Helper\DisplayCost',
			),
    	    'factories' => array(
    	        'rightSideBar' => 'Events\View\Helper\RightSideBarFactory',
    	    ),
    	);
    }
    
}
