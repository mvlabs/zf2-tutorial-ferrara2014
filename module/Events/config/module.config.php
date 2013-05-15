<?php

namespace Events;

return array(
    'router' => array(
        'routes' => array(
            'events' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/events',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Events\Controller',
                        'controller'    => 'Events',
                        'action'        => 'index',
                    ),
                ),
            ),
            
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
