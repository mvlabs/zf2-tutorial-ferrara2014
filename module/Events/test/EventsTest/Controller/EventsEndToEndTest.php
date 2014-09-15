<?php
namespace EventsTest\Controller;

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
