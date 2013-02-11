<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Dollyaswin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Dollyaswin\Form\Login;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
    	$loginForm = new Login;
    	if ($this->getRequest()->isPost()) {
    		
    	}
    	
        return new ViewModel(array('title' => 'Log In',
                                     'form'  => $loginForm,
                                     ));
    }
}
