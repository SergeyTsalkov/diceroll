<?php

function smarty_function_csrf($params, Smarty_Internal_Template $template) {
  if (! $_SESSION['csrf']) $_SESSION['csrf'] = Str::random(30);
  return $_SESSION['csrf'];
}