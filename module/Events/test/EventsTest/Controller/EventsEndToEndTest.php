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
    
}
