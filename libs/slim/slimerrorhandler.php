<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
 
class SlimErrorHandler extends \Slim\Handlers\Error { 
  public function __invoke(Request $request, Response $response, \Exception $e) {
    $this->displayErrorDetails = IS_DEVELOPMENT;
    return parent::__invoke($request, $response, $e);
  }
}