<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class TemplateVarMiddleware extends SlimMiddleware {
  function __invoke(Request $request, Response $response, callable $next) {
    if ($Route = $request->getAttribute('route')) {
      $route_name = $Route->getName();
      $this->SetContext('route_name', $route_name);
      $this->SetContext('is_production', IS_PRODUCTION);
      $this->SetContext('is_development', IS_DEVELOPMENT);
    }

    return $next($request, $response);
  }
}
