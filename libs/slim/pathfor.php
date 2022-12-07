<?php

class pathFor {
  public $Container;
  public $RouteParser;

  function __construct($Container) {
    $this->Container = $Container;
    $this->RouteParser = new FastRoute\RouteParser\Std();
  }

  function __invoke($name, $args=[]) {
    $Slim = $this->Container;
    $RouteParser = $this->RouteParser;

    if (! $name) $name = $Slim->view['route_name'];
    if (! $name) return '#';

    $Route = $Slim->router->getNamedRoute($name);
    if (! $Route) return '#';

    if ($args['keep_current_params']) {
      $exclude = explode(',', strval($args['exclude_params']));
      unset($args['keep_current_params']);
      unset($args['exclude_params']);
      $args = array_merge($Route->getArguments(), $Slim->request->getQueryParams(), $args);
      if ($exclude) $args = array_diff_key($args, array_flip($exclude));
    }

    if ($args['pathfor_fullpath']) {
      unset($args['pathfor_fullpath']);
      $prefix = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    }

    if ($args) {
      $routeParams = [];

      $routeDatas = $RouteParser->parse($Route->getPattern());
      foreach ($routeDatas as $routeData) {
        foreach ($routeData as $item) {
          if (! is_array($item)) continue;

          $routeParams[$item[0]] = true;
        }
      }

      $params = array_intersect_key($args, $routeParams);
      $query = array_diff_key($args, $params);
    }

    try {
      return $prefix . $Slim->router->pathFor($name, $params ? $params : [], $query ? $query : []);
    } catch (Exception $e) {
      say_error("pathFor error:", $e->getMessage());
      return '#';
    }
  }
}