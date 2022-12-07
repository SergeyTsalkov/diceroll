<?php

function githead() {
  static $head;

  if (! $head && IS_DEVELOPMENT) {
    $head = str_random();
  }
  if (! $head) {
    $head = trim(@file_get_contents(BASE_DIR . '/.git/refs/heads/master'));
  }
  if (! $head) {
    $file = @file_get_contents(BASE_DIR . '/.git/packed-refs');
    if (preg_match('/^(\w+)\s+refs\/heads\/master$/im', $file, $match)) {
      $head = $match[1];
    }
  }

  return $head;
}

function str_random($length = 7, $chars = "abcdefghijkmnopqrstuvwxyz023456789") {
  $str = '';

  for ($i = 0; $i < $length; $i++) {
    $char = substr($chars, random_int(0, strlen($chars) - 1), 1);
    $str = $str . $char;
  }

  return $str;
}
