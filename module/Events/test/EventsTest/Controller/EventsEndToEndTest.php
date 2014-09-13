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

    
    public function testEventsLinkOnHomePage() {
        
    	$this->dispatch('/');
    	    	
        // two ways to assert the same thing
        $this->assertXPathQueryContentContains('/html/body/div/header/div/nav/ul/li[1]/a', 'Attend');
    	$this->assertQueryContentContains("header nav ul li a", "Attend");
        
    }
    
    public function testEventsPageContainsCorrectTexts() {
        
        $this->dispatch('/events');
        
        $this->assertQueryContentContains("div.title-page hgroup h2", "Best Conferences");
        
        $this->assertQueryContentContains("#content div.conferences div.events-head h4", "Conference List");
        
    }
    
    
}
