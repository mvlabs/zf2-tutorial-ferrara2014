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
        return new ViewModel();
    }
    
    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        
        // make sure this is a good restful implementation,
        // not just some random data 
        // return new JsonModel($I_eventService->getListArray());
        
        $events = array(
            array('id' => 1, 'name'=>'PHPDay 2013', 'country' => 'Italy', 'parent' => 'http://zf2-hubmein/api/1'),
            array('id' => 2, 'name'=>'JSDay 2013', 'country' => 'Italy', 'parent' => 'http://zf2-hubmein/api/2')
            );
        
        return new JsonModel($events);
        
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
        
        $data = $I_eventService->getEvent($id)->getArrayCopy();
        $data['parent'] = 'http://zf2-hubmein/api';
        
        return new JsonModel($data);
    }
    
    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return mixed
     */
    public function create($data)
    {
        //TODO: Implement Method
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