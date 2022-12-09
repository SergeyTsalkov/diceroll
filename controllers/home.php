<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController extends SlimController {
  function Home(Request $Req, Response $Resp, array $args) {
    return $this->render($Resp, 'index.tpl');
  }

  function Roll(Request $Req, Response $Resp, array $args) {
    $Post = $Req->getParsedBody();

    try {
      $results = diceroll($Post['roll']);
    } catch (Exception $e) {
      return $Resp->write(json_encode(['error' => 'Invalid dice roll']));
    }

    return $Resp->write(json_encode($results));
  }
}
