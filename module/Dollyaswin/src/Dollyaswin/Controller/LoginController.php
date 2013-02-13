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
    Zend\Session\Container as SessionContainer,
    Zend\View\Model\ViewModel,
    Dollyaswin\Form\Login;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
    	$authService = $this->serviceLocator->get('auth_service');
    	if ($authService->hasIdentity()) {
    		// if not log in, redirect to login page
    		return $this->redirect()->toUrl('/main');
    	}
    	
    	$form = new Login;
    	if ($this->getRequest()->isPost()) {
    		$form->setData($this->getRequest()->getPost());
    		if (! $form->isValid()) {
    			// not valid form
    			return new ViewModel(array(
    								'title' => 'Log In',
    								'form'  => $form,
    								));
    		}
    		
    		$loginData = $form->getData();
			$authService = $this->serviceLocator->get('auth_service');
			$authService->getAdapter()
			            ->setIdentity($loginData['username'])
			            ->setCredential($loginData['password']);
			// do authentication
    		$result = $authService->authenticate();
    		if ($result->isValid()) {
    			$this->redirect()->toUrl('/main');
    		} else {
    			$loginMsg = $result->getMessages();
    		}
    	}
    	
        return new ViewModel(array('title' => 'Log In',
                                     'form'  => $form,
        							 'loginMsg' => $loginMsg
                                     ));
    }
    
    public function logoutAction()
    {
    	$authService = $this->serviceLocator->get('auth_service');
    	if (! $authService->hasIdentity()) {
    		// if not log in, redirect to login page
    		return $this->redirect()->toUrl('/login');
    	}
    	
    	$authService->clearIdentity();
    	return $this->redirect()->toUrl('/main');
    }
    
    public function twitterAction()
    {
		$consumer = $this->serviceLocator->get('twitter_oauth');
        $token = $consumer->getRequestToken();
        $session = new SessionContainer('twitter_oauth');
        $session->requestToken = serialize($token);
        // redirect the user to twitter authorize page
        $consumer->redirect();
    }
    
    public function twitterCallbackAction()
    {
    	$consumer = $this->serviceLocator->get('twitter_oauth');
    	$session = new SessionContainer('twitter_oauth');
    	$token = $consumer->getAccessToken(
    				$this->params()->fromQuery(),
    				unserialize($session->requestToken)
             	);
        print_r($token);
       	exit;
    }
}