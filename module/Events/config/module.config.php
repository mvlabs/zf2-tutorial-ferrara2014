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
                'may_terminate' => true,
                'child_routes' => array(
                    'promote' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/promote',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Events\Controller',
                                'controller'    => 'Events',
                                'action'        => 'promote',
                            ),
                        )
                    ),
                    'process' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/process',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Events\Controller',
                                'controller'    => 'Events',
                                'action'        => 'process',
                            ),
                        )
                    ),
                    'thanks' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/thanks',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Events\Controller',
                                'controller'    => 'Events',
                                'action'        => 'thankyou',
                            ),
                        )
                    ),
                ),
            ),
            'event' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/event',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Events\Controller',
                        'controller'    => 'Events',
                        'action'        => 'event',
                    ),
                )
            ),
            
        ),
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
