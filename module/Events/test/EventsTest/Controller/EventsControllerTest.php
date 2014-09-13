<?php
namespace EventsTest\Controller;

use Zend\Mvc\Application;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class ApplicationControllerTest extends AbstractHttpControllerTestCase {
    
    public function setUp() {
    	$this->setApplicationConfig(include __DIR__ . '/../../TestConfig.php.dist');
    	parent::setUp();
    }

    
    public function testEventsPageAccess() {
        
    	$this->dispatch('/events');
    	$this->assertResponseStatusCode(200);
    	$this->assertModuleName('events');
    	$this->assertControllerName('events\controller\events');
    	$this->assertControllerClass('EventsController');
    	$this->assertActionName('index');
    	$this->assertMatchedRouteName('events');
    	
    }
    
}
