<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Replace\Controller\Replace' => 'Replace\Controller\ReplaceController',
        ),
    ),
	 
	'router' => array(
        'routes' => array(
            'replace' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/replace[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Replace\Controller\Replace',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
	 
    'view_manager' => array(
        'template_path_stack' => array( 'replace' => __DIR__ . '/../view',  ),
    ),
);