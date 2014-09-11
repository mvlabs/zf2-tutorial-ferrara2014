<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator\Hostname as HostnameValidator;

class FeedbackFilter extends InputFilter {
    	
    public function __construct() {   	
		
	$this->add(array(
            'name'       => 'name',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
            	array(
                    'name' => 'not_empty',
                ),                
            ),
        ));
        	
	$this->add(array(
            'name'       => 'email',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
            	array(
                    'name' => 'EmailAddress',
                ),                
            ),
        ));
        
        	
	$this->add(array(
            'name'       => 'message',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
            	array(
                    'name' => 'not_empty',
                ),                
            ),
        ));
		
		
			
    }
}
