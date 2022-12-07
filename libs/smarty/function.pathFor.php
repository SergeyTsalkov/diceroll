<?php

function smarty_function_pathFor($args, Smarty_Internal_Template $template) {
  $name = $args['rtname'];
  unset($args['rtname']);

  $Slim = $template->getRegisteredObject('SlimContainer');
  $pathFor = $Slim->pathFor;
  return $pathFor($name, $args);
}