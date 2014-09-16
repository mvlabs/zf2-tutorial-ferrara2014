<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TeamController extends AbstractActionController
{
    public function indexAction()
    {
        // Forward to members
        return $this->redirect()->toRoute('application/default', 
                                          array('controller' => 'team', 
                                                'action' => 'members')
                                         );
    }
    
    public function membersAction()
    {
    	  return new ViewModel();
    }
    
    public function memberAction()
    {
          $slugParam = $this->params('slug');
    	  return new ViewModel(array('controllerDefinedSlug' => $slugParam));
    }
}
