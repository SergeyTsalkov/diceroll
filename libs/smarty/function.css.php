<?php

function smarty_function_css($args, Smarty_Internal_Template $template) {
  if (! $args['url']) throw new Exception("css tag invalid without url");
  $text = sprintf('<link rel="stylesheet" href="%s?%s">', $args['url'], githead());
  $template->append('css_include_array', $text);
}