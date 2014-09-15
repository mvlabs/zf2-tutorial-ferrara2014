<?php
namespace EventsTest\Controller;

use Zend\Mvc\Application;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class EventsEndToEndTest extends AbstractHttpControllerTestCase {
        
    private $serviceManager;
    
    public function setUp() {
    	$this->setApplicationConfig(include __DIR__ . '/../../TestConfig.php.dist');
    	parent::setUp();
                
        $this->serviceManager = \Bootstrap::getServiceManager();
    }

    
    /**
     * @test
     */
    public function existsAFilterBoxWithTwoCountries() {
        
    	$this->dispatch('/events');
    	
    	$this->assertResponseStatusCode(200);
    	$this->assertControllerClass('EventsController');
    	$this->assertActionName('index');
    	
        // form existance
        $this->assertQuery('#sidebar form');
        
        $expectedResults = array('Italy', 'UK');
        foreach($expectedResults as $result) {
            $this->assertQueryContentContains("#sidebar form #country option", $result);
        }
    	
    }
        
    /**
     * @test
     */
    public function searchEventBasedOnCountryItaly() {
        
        $controller = new \Events\Controller\EventsController($this->serviceManager->get('Events\Service\EventService'));
        $request    = new Request();
        
        $routeMatch = new RouteMatch(array('controller' => 'events'));
        $routeMatch->setParam('action', 'index');
        
        $event      = new MvcEvent();
        $event->setRouteMatch($routeMatch);
        $controller->setEvent($event);
        
        $request->getQuery()->set('country', 'Italy');
        
        $result = $controller->dispatch($request);
        
        $response = $controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
 
        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
 
        // Test the parameters contained in the View model
        $vars = $result->getVariables();
        
        $expectedResult = 3;
        $this->assertCount($expectedResult, $vars['events']);
        
    }
    
    /**
     * @test
     */
    public function correctUrlOnEventSearchBasedOnCountryItaly() {
        
        $this->dispatch('/events?country=Italy');
        
        $this->assertResponseStatusCode(200);
    	$this->assertControllerClass('EventsController');
    	$this->assertActionName('index');
        
        $this->assertQueryCount("div.conferences div.event", 3);
        
    }
    
    /**
     * @test
     */
    public function searchEventBasedOnCountryUK() {
        
        $controller = new \Events\Controller\EventsController($this->serviceManager->get('Events\Service\EventService'));
        $request    = new Request();
        
        $routeMatch = new RouteMatch(array('controller' => 'events'));
        $routeMatch->setParam('action', 'index');
        
        $event      = new MvcEvent();
        $event->setRouteMatch($routeMatch);
        $controller->setEvent($event);
        
        $request->getQuery()->set('country', 'UK');
        
        $result = $controller->dispatch($request);
        
        $response = $controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
 
        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
 
        // Test the parameters contained in the View model
        $vars = $result->getVariables();
        
        $expectedResult = 0;
        $this->assertCount($expectedResult, $vars['events']);
        
    }
    
    /**
     * @test
     */
    public function correctUrlOnEventSearchBasedOnCountryUK() {
        
        $this->dispatch('/events?country=UK');
        
        $this->assertResponseStatusCode(200);
    	$this->assertControllerClass('EventsController');
    	$this->assertActionName('index');
        
        $this->assertQueryCount("div.conferences div.event", 1);
        
        $this->assertQueryContentContains('div.conferences div.event div.event-info h3', 
                                          'No events happening in selected country soon.');
        
    }
    
    
}
