<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FeedbackController extends AbstractActionController
{
    
    /**
     * Feedback Form 
     *  
     * @var \Zend\Form\Form
     */
    private $form;
    
    /**
     * Class constructor
     * 
     * @param \Zend\Form\Form $form
     */
    public function __construct(\Zend\Form\Form $form) {
        $this->form = $form;
    }

    /**
     * Displays feedback page (with form)
     * 
     * @return multitype:\Zend\Form\Form
     */
    public function indexAction() {
        return array(
            'form' => $this->form,
        );
    }
    
    public function sendAction() {
        
        // store into db, send mails, etc
        file_put_contents(__DIR__ . '/../../../../../data/data.json', json_encode($this->request->getPost()->toArray()));
        
        return $this->redirect()->toRoute('feedback/thankyou');
        
    }
    
    public function thankyouAction() {
        return array(
        );
    }
            
}