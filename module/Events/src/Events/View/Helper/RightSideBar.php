<?php

namespace Events\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class RightSideBar extends AbstractHelper {

    private $countries;
    
    public function __construct() {
            
        $this->countries = array('Italy', 'UK');
        
    }
    
    public function __invoke() {

        return $this->view->render('partials/filterbox.phtml', array('countries' => $this->countries));

    }

}