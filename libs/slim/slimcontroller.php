<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Interop\Container\ContainerInterface as ContainerInterface;

abstract class SlimController extends SlimObject {
  protected function render(...$args) { return $this->Container->view->render(...$args); }
}