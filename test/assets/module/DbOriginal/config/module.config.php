<?php

namespace LaminasTestApiToolsDb;

return array(
    'service_manager' => array(
        'invokables' => array(
            'Artist_aggregate_listener' =>
                'LaminasTestApiToolsDb\EventListener\ArtistAggregateListener',
        ),
    ),
    'api-tools-doctrine-query-provider' => array(
        'invokables' => array(
            'Artist_default' => 'LaminasTestApiToolsDb\Query\Provider\Artist\DefaultQueryProvider',
            'Artist_update' => 'LaminasTestApiToolsDb\Query\Provider\Artist\UpdateQueryProvider',
        )
    ),
    'api-tools-doctrine-query-create-filter' => array(
        'invokables' => array(
            'Artist' => 'LaminasTestApiToolsDb\Query\CreateFilter\ArtistCreateFilter',
        )
    ),
    'api-tools' => array(
        'doctrine-connected' => array(
            'LaminasTestApiToolsDbApi\\V1\\Rest\\Artist\\ArtistResource' => array(
                'query_create_filter' => 'Artist',
                'query_providers' => array(
                    'default' => 'Artist_default',
                    'update' => 'Artist_update',
                ),
                'listeners' => array(
                    'Artist_aggregate_listener',
                ),
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
           'db_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => array(__DIR__ . '/xml'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => 'db_driver',
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'json_exceptions'          => array(
            'display'    => true,
            'ajax_only'  => true,
            'show_trace' => true
        ),

        'doctype'            => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map'       => array(),
        'strategies'         => array(
            'ViewJsonStrategy',
        ),
    ),
);
