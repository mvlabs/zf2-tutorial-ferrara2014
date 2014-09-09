<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        
        // Route listener is created for module, allowing it to 
        // handle dispatching
        $I_application       = $e->getApplication();
        $I_eventManager      = $I_application->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($I_eventManager);
        
        
        // attach to ZfcUser's 'register' event
        $eventManager = $e->getApplication()->getEventManager();

        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();
        $entityManager = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');
        
        $zfcServiceEvents->attach('register', function($e) use ($entityManager) {

            $user = $e->getParam('user');

            // by default all created users are admin
            $user->setRole($entityManager->getReference('\Application\Entity\Role', 'admin'));
            
        });

        
    }

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
}
