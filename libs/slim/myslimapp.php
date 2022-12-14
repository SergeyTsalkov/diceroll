<?php

class MySlimApp extends \Slim\App {
  function __construct() {
    parent::__construct([
      'settings' => [
        'displayErrorDetails' => IS_DEVELOPMENT,
        'determineRouteBeforeAppMiddleware' => true,
      ]
    ]);

    $Container = $this->getContainer();
    $Container['view'] = function($Container) {
      $Smarty = new Smarty();
      $Smarty->setTemplateDir(TEMPLATE_DIR);
      $Smarty->setCompileDir(TEMPLATE_C_DIR);
      $Smarty->addPluginsDir(LIB_DIR . '/smarty');
      $Smarty->escape_html = true;
      $Smarty->force_compile = IS_DEVELOPMENT;
      $Smarty->compile_id = function_exists('posix_geteuid') ? posix_geteuid() : null;
      $Smarty->registerObject('SlimContainer', $Container);
      return new SmartyView($Smarty);
    };
    $Container['User'] = function($Container) {
      return new StdClass();
    };
    $Container['errorHandler'] = function($Container) {
      return new SlimErrorHandler();
    };

    $this->get('/', 'HomeController:Home')->setName('home');
    $this->post('/roll', 'HomeController:Roll')->setName('roll');
    $this->get('/scss/{filename:\w+\.s?css}', 'SCSSController:show');
  }
}
