<?php

function smarty_function_link_tag($args, Smarty_Internal_Template $template) {
  if (! $args['href']) throw new Exception("link_tag invalid without href");

  $parts = [];
  foreach ($args as $key => $value) {
    if ($key == 'href') $value .= '?' . githead();
    $parts[] = sprintf('%s="%s"', $key, $value);
  }

  return $parts ? sprintf('<link %s>', implode(' ', $parts)) : '';
}