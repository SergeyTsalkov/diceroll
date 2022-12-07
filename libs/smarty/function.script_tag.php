<?php

function smarty_function_script_tag($args, Smarty_Internal_Template $template) {
  if (! $args['src']) throw new Exception("script_tag invalid without src");

  $parts = [];
  foreach ($args as $key => $value) {
    if ($key == 'src') $value .= '?' . githead();
    $parts[] = sprintf('%s="%s"', $key, $value);
  }

  return $parts ? sprintf('<script %s></script>', implode(' ', $parts)) : '';
}