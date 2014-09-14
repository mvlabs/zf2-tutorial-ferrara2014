<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CliController extends AbstractActionController
{
    public function eventsStreamAction()
    {
    
        $queueService = $this->getServiceLocator()->get('Application\Service\QueueService');
        
        $queueService->loop();
        
    }
    
}
