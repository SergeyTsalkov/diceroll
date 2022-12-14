<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', '1');
mb_internal_encoding('UTF-8');

define('IS_CONSOLE', php_sapi_name() == 'cli');
define('LIB_DIR', realpath(__DIR__));
define('BASE_DIR', realpath(LIB_DIR . '/../'));
define('TEMPLATE_DIR', realpath(BASE_DIR . '/templates'));
define('SCSS_DIR', realpath(BASE_DIR . '/scss'));
define('PUBLIC_DIR', realpath(BASE_DIR . '/public'));
define('HOSTNAME', $_SERVER['HTTP_HOST']);

define('TMP_DIR', BASE_DIR . '/tmp');
init_writeable_dir('TMP_DIR', TMP_DIR);

define('TEMPLATE_C_DIR', TMP_DIR . '/templates_c');
init_writeable_dir('TEMPLATE_C_DIR', TEMPLATE_C_DIR);

require_once BASE_DIR . '/vendor/autoload.php';

// RANDOM_ORG_API_KEY, IS_DEVELOPMENT
require_once LIB_DIR . '/config.php';

define('IS_PRODUCTION', !IS_DEVELOPMENT);

class UserException extends Exception {
  public $jumpto;

  function __construct($message, $jumpto=null) {
    $this->message = $message;
    $this->jumpto = $jumpto;
  }
}

function init_writeable_dir(string $type, string $dir) {
  if (!is_dir($dir)) {
    @mkdir($dir);
    @chmod($dir, 0777);
  }
  if (!is_dir($dir) || !is_writable($dir)) throw new Exception("$type ($dir) is not accessible!");
}

function githead() {
  static $head;

  if (! $head && IS_DEVELOPMENT) {
    $head = '';
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
