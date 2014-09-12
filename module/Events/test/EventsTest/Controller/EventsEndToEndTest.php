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
        
    
    public function setUp() {
    	$this->setApplicationConfig(include __DIR__ . '/../../TestConfig.php.dist');
    	parent::setUp();
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
    
    protected function getEmMock()
    {   
        $emMock  = $this->getMock('\Doctrine\ORM\EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush'), array(), '', false);
        /*$emMock->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue(new FakeRepository()));*/
        $emMock->expects($this->any())
            ->method('getClassMetadata')
            ->will($this->returnValue((object)array('name' => 'aClass')));
        $emMock->expects($this->any())
            ->method('persist')
            ->will($this->returnValue(null));
        $emMock->expects($this->any())
            ->method('flush')
            ->will($this->returnValue(null));
        return $emMock;  // it tooks 13 lines to achieve mock!
     }
    
    /**
     * @test
     */
    public function searchEventBasedOnCountryItaly() {
        
        // mock service
        $doctrineEM = $this->getEmMock();
        $mapper = $this->getMock('\Events\Mapper\DoctrineEventMapper',
                  array('__construct', 'findAll'),
                  array($doctrineEM));
        
        $service = $this->getMock('\Events\Service\EventService', 
                   array('__construct'),
                   array($mapper));
        
        
        $service->expects($this->once())
                ->method('__construct');
        
        
        $controller = new \Events\Controller\EventsController($service);
        $request    = new Request();
        
        $routeMatch = new RouteMatch(array('controller' => 'events'));
        $routeMatch->setParam('action', 'index');
        
        $event      = new MvcEvent();
        $event->setRouteMatch($routeMatch);
        $controller->setEvent($event);
        
        $request->getQuery()->set('country', 'Italy');
        
        $result = $controller->dispatch($request);
        //$result = $controller->dispatch('/events?country=Italy');
        
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
    /*public function searchEventBasedOnCountryUK() {
        
        $result = $this->dispatch('/events?country=UK');
        
        $this->assertResponseStatusCode(200);
 
        // Check for a ViewModel to be returned
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
 
        // Test the parameters contained in the View model
        $vars = $result->getVariables();
        
        $expectedResult = 0;
        $this->assertCount($expectedResult, $vars['events']);
        
    }*/
    
}
