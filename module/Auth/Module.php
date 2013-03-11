<?php
namespace Auth;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway,
    Zend\Http\Client as HTTPClient,
    ZendOAuth\OAuth,
    Auth\Model\User,
    Auth\Model\UserTable;

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
    				$authService = new AuthenticationService(new SessionStorage('auth'));
//    				$authService->setStorage(new SessionStorage('auth'));
    				return $authService;
    			},
    			'twitter_oauth' => function ($sm) {
    			    $httpConfig = array(
    			                         'adapter' => 'Zend\Http\Client\Adapter\Socket',
    			                         'sslverifypeer' => false
    			                     );
    			    $httpClient = new HTTPClient(null, $httpConfig);
    			    OAuth::setHttpClient($httpClient);
    				$config = $sm->get('Config');
    				$consumer = new \ZendOAuth\Consumer($config['twitter']);
    				return $consumer;
    			},
    			'Auth\Model\UserTable' =>  function($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
    		)
    	);
    }
}
