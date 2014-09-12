<?php

namespace Events\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class RightSideBar extends AbstractHelper {

    private $countries;
    
    private $currentCountry;
    
    public function __construct() {
        
    }
    
	public function __invoke() {
		
		$html = '<aside id="sidebar" class="fr">
		<div class="rounded-box-title box">
		<div class="box-inner clearfix">
		
		</div>
		</div><!-- END: box -->
		</aside>
        <!-- END: sidebar -->';
	    
	    return $html;
	    
	}

}