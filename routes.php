<?php
$controllers = array(
  'pages' => ['home', 'error'],
  'categories' => ['index', 'create', 'update', 'delete', 'updatePriority'],
  'decorate_categories' => ['index', 'create', 'update', 'delete', 'updatePriority'],
  'images' => ['index', 'create', 'update', 'delete', 'updatePriority'],
  'decorate_images' => ['index', 'create', 'update', 'delete', 'updatePriority'],
  'splashes' => ['index', 'update'],
  'textborder_categories' => ['index', 'create', 'update', 'delete'],
  'textborder_images' => ['index', 'create', 'update', 'delete'],
  'fonts' => ['index', 'create', 'update', 'delete'],
);
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'pages';
  $action = 'error';
}
include_once('controllers/' . $controller . '_controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
