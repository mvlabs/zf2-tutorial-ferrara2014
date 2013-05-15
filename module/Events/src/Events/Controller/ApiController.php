<?php

namespace Events\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mail\Transport;
use Zend\Mail\Message as Message;

class ApiController extends AbstractRestfulController {
    
    public function indexAction()
    {
        echo "INDEX";
        return new ViewModel();
    }
    
    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        
        $I_eventService = $this->getServiceLocator()->get('Events\Service\EventService');
        
        return new JsonModel($I_eventService->getListArray());
        
    }
    
    /**
     * Return single resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        $I_eventService = $this->getServiceLocator()->get('Events\Service\EventService');
        
        return new JsonModel($I_eventService->getEvent($id)->toArray());
    }
    
    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return mixed
     */
    public function create($data)
    {
        echo "POST";
        return new JsonModel(array());
    }
    
    /**
     * Update an existing resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update($id, $data)
    {
        //TODO: Implement Method
    }
    
    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        //TODO: Implement Method
    }
    
}