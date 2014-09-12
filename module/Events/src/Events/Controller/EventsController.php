<?php

namespace Events\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail\Transport;
use Zend\Mail\Message as Message;

class EventsController extends AbstractActionController
{
    
    
    /**
     * Main service for handling events (IE conferences)
     * 
     * @var \Events\Service\EventService
     */
    private $eventService;
    
    
    /**
     * Class constructor
     * 
     * @param \Events\Service\EventService $eventService
     */
    public function __construct(\Events\Service\EventService $eventService) {
        $this->eventService = $eventService;
    }
    
    /**
     * Returns a list of events, as fethched from model
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
    	return new ViewModel(array('events' => $this->eventService->getList()));
    }
    
    /**
     * Displays a specific event 
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function eventAction() {
    	$id = $this->getRequest()->getQuery('id');
    	return new ViewModel(array('event' => $this->eventService->getEvent($id)));
    }

}
