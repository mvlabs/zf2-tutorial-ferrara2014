<?php
namespace ApplicationTest\Controller;

use Zend\Mvc\Application;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class FeedbackControllerTest extends AbstractHttpControllerTestCase {
    
    public function setUp() {
    	$this->setApplicationConfig(include __DIR__ . '/../../TestConfig.php.dist');
    	parent::setUp();
    }

    
    public function testFeedbackPageIsReachable() {
        
    	$this->dispatch('/feedback');
    	
    	$this->assertResponseStatusCode(200);
    	$this->assertControllerClass('FeedbackController');
    	$this->assertActionName('index');
        
    }
    
    public function testFeedbackPageContainsAFeedbackForm() {
            
        $this->dispatch('/feedback');
        
        $this->assertQueryCount("form#feedback-form", 1);
    	
    	$this->assertQueryContentContains("div.border-bottom h2 strong", "Help Us Out!");
    	
    	// Counting elements
    	$this->assertQueryCountMax("#feedback-form div", 4);
        
    }
    
    public function testFeedbackSentValid() {
        
        $formData = array (
            'name' => 'Bob',
            'email' => 'email@me.com',
            'message' => 'I love hubme.in!',
            'submit' => 'Submit'
        );

    	$this->dispatch('/feedback/send', 'POST', $formData);
    	
        
        $sentData = file_get_contents(__DIR__ . '/../../../../../data/data.json');
        $this->assertEquals($sentData, json_encode($formData));
        
    }
    
    public function testFeedbackSentMissingName() {
        
        $formData = array (
            'email' => 'email@me.com',
            'message' => 'I love hubme.in!',
            'submit' => 'Submit'
        );

    	$this->dispatch('/feedback/send', 'POST', $formData);
    	
        $this->assertResponseStatusCode(200);
    	$this->assertControllerClass('FeedbackController');
    	$this->assertActionName('send');
        
    }
    
    public function testFeedbackSentWrongRequestVerb() {
        
    	$this->dispatch('/feedback/send', 'GET');
    	
        $this->assertResponseStatusCode(404);
        
    }
    
    public function tearDown() {
    	@unlink(__DIR__ . '/../../../../../data/data.json');
    	parent::tearDown();
    }
    
}
