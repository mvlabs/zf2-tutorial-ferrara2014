<?php

namespace Application\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\Validator;

class Feedback extends Form {
    	
    public function __construct() {
        
        parent::__construct('feedback');
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
            	'id'    => 'name',
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Your name',
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'id'    => 'email',
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Your email',
            ),
        ));
        
        $this->add(array(
            'name'  => 'message',
            'attributes' => array(
            	'id'    => 'message',
                'type'  => 'textarea',
                'cols'  => '40',
                'rows'  => '8',
            ),
            'options' => array(
                'label' => 'Message',
            )
        ));
                
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
            	'id'    => 'submit',
                'type'  => 'submit',
                'value' => 'Submit',
                'class' => 'bigbutton'
            ),
            'options' => array('label' => '.')
        ));
                
    }	  
}