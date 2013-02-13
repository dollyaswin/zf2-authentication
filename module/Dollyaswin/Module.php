<?php
namespace Dollyaswin;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Adapter\DbTable,
    Zend\Authentication\Storage\Session as SessionStorage;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'auth_service' => function ($sm) {
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$authService = new AuthenticationService();
    				// use DbTable adapter
					$authAdapter = new DbTable($dbAdapter, 'user', 'username', 'password', 'MD5(?)');
					$authService->setAdapter($authAdapter)
    							->setStorage(new SessionStorage('auth'));
    				return $authService;
    			},
    			'twitter_oauth' => function ($sm) {
    				$config = $sm->get('Config');
    				$consumer = new \ZendOAuth\Consumer($config['twitter']);
    				return $consumer;
    			}
    		)
    	);
    }
}
