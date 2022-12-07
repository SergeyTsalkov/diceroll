<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController extends SlimController {
  function Home(Request $Req, Response $Resp, array $args) {
    return $this->render($Resp, 'index.tpl');
  }
}
