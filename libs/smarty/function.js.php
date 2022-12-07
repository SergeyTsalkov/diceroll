<?php

function smarty_function_js($args, Smarty_Internal_Template $template) {
  if (! $args['url']) throw new Exception("js tag invalid without url");

  $text = sprintf('<script src="%s?%s"></script>', $args['url'], githead());
  $template->append('js_include_array', $text);
}