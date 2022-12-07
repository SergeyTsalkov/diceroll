<?php
use Psr\Http\Message\ResponseInterface as Response;

class SmartyView implements ArrayAccess {
  private $Smarty;
  private $data = [];

  function __construct($Smarty) {
    $this->Smarty = $Smarty;
  }

  function fetch(string $tpl, $args=[]) {
    if (! is_array($args)) $args = [];
    $args = array_merge($this->data, $args);

    try {
      $this->Smarty->assign($args);
      $output = $this->Smarty->fetch($tpl);
    } finally {
      $this->Smarty->clearAllAssign();
    }
    
    return $output;
  }

  function render(Response $Resp, string $tpl, $args=[]) {
    $Resp->getBody()->write($this->fetch($tpl, $args));
    return $Resp;
  }

  function jumpnotice($jumpto=null, string $alert='') {
    if ($alert) $_SESSION['flash']['notice'][] = $alert;
    return (new \Slim\Http\Response())->withRedirect($jumpto);
  }

  function jumperror($jumpto=null, string $alert='') {
    if ($alert) $_SESSION['flash']['error'][] = $alert;
    return (new \Slim\Http\Response())->withRedirect($jumpto);
  }

  function offsetExists($offset) { return isset($this->data[$offset]); }
  function offsetGet($offset) { return $this->data[$offset]; }
  function offsetSet($offset, $value) { $this->data[$offset] = $value; }
  function offsetUnset($offset) { unset($this->data[$offset]); }
}