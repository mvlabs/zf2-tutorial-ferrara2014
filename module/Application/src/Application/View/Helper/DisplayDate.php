<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayDate extends AbstractHelper {

	public function __invoke() {
		
	    $datetime = new \DateTime();
		return $datetime->format('d/m/Y H:i');
		
	}

}