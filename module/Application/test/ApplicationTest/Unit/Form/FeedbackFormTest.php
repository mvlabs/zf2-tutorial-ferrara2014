<?php

use Application\Form\Feedback as FeedbackForm;

class FeedbackFormTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var Application\Form\Feedback
     */
    private $form;

    public function setUp() {
        parent::setUp();
      
        $this->form = new FeedbackForm();
        
    }

    /**
     * @test
     */
    public function areFieldsValid() {

        $name = $this->form->get("name");
        $this->assertInstanceOf("Zend\Form\Element", $name);
        
        $email = $this->form->get("email");
        $this->assertInstanceOf("Zend\Form\Element", $email);

        $message = $this->form->get("message");
        $this->assertInstanceOf("Zend\Form\Element", $message);
        
    }
     

}
