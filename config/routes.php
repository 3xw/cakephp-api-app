<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Trois\Utils\Routing\Mapper;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder)
{
  // HTML
  $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

  // API
  $resources = [
    'A' => [
      'B' => ['C']
    ],
  ];

  Mapper::mapRessources($resources, $builder);

  $builder->setExtensions(['json']);
  $builder->fallbacks();
});
