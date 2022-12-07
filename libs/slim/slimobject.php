<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface as ContainerInterface;

abstract class SlimObject {
  protected $Container;

  function __construct(ContainerInterface $Container) {
    $this->Container = $Container;
  }

  function GetContext($key) { return $this->Container->User->$key; }
  function SetContext($key, $val) { 
    $this->Container->User->$key = $val; 
    $this->Container->view[$key] = $val;
  }
  
  function pathFor() {
    return call_user_func_array($this->Container->pathFor, func_get_args());
  }

  // jumps can be used from Controller or Middleware
  protected function jumpnotice(...$args) { return $this->Container->view->jumpnotice(...$args); }
  protected function jumperror(...$args) { return $this->Container->view->jumperror(...$args); }
  protected function jump($url) { return $this->Container->view->jumpnotice($url); }
}