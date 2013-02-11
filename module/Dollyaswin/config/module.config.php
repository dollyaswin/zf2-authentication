<?php
return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Dollyaswin\Controller',
                        'controller'    => 'Login',
                        'action'        => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Dollyaswin\Controller',
                        'controller'    => 'Login',
                        'action'        => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
    ),
    'controllers' => array(
        'invokables' => array(
            'Dollyaswin\Controller\Login' => 'Dollyaswin\Controller\LoginController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
