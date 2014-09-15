<?php
namespace EventsTest\Controller;

use Zend\Mvc\Application;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class EventsControllerTest extends AbstractHttpControllerTestCase {
        
    private $serviceManager;
    
    public function setUp() {
    	$this->setApplicationConfig(include __DIR__ . '/../../TestConfig.php.dist');
    	parent::setUp();
                
        $this->serviceManager = \Bootstrap::getServiceManager();
    }
    
    private function createRequest($country) {
        
        $controller = new \Events\Controller\EventsController($this->serviceManager->get('Events\Service\EventService'));
        $request    = new Request();
        
        $routeMatch = new RouteMatch(array('controller' => 'events'));
        $routeMatch->setParam('action', 'index');
        
        $event      = new MvcEvent();
        $event->setRouteMatch($routeMatch);
        $controller->setEvent($event);
        
        $request->getQuery()->set('country', $country);

        $result = $controller->dispatch($request);
        
        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
 
        // Test the parameters contained in the View model
        return $result->getVariables();
        
    }

    
    /**
     * @test
     */
    public function searchEventBasedOnCountryItaly() {
        
        $vars = $this->createRequest('Italy');
        
        $expectedResult = 3;
        $this->assertCount($expectedResult, $vars['events']);
        
    }
    
    /**
     * @test
     */
    public function searchEventBasedOnCountryUK() {
        
        $vars = $this->createRequest('UK');
        
        $expectedResult = 0;
        $this->assertCount($expectedResult, $vars['events']);
        
    }
        
    
}
