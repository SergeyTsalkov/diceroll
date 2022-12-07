<?php
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\AbstractProcessingHandler;

function logger() {
  global $stdout;
  
  static $logger;
  if (! $logger) {
    if (IS_CONSOLE) {
      $logger = new Logger(basename($_SERVER['SCRIPT_NAME']));
    } else {
      $logger = new Logger('web');
    }

    if (IS_PRODUCTION) {
      $debug_time = 7;
      $info_time = 0;
    } else {
      $debug_time = $info_time = 3;
    }

    $logger->pushHandler(new RotatingFileHandler(LOG_DIR . '/meekro-debug.log', $debug_time, Logger::DEBUG, true, 0666, true));
    $logger->pushHandler(new RotatingFileHandler(LOG_DIR . '/meekro-info.log', $info_time, Logger::INFO, true, 0666, true));
    
    if (IS_CONSOLE) {
      // make stdout redirectable
      if (!@stream_get_meta_data($stdout)) $stdout = STDOUT;

      $StdoutHandler = new StreamHandler($stdout, Logger::DEBUG);
      $StdoutHandler->setFormatter(new LineFormatter("%message%\n"));
      $logger->pushHandler($StdoutHandler);
    }

  }

  return $logger;
}


function say_debug(...$strs) { logger()->addDebug(implode(' ', $strs)); }
function say_debugf(...$strs) { say_debug(sprintf(...$strs)); }

function say(...$strs) { logger()->addInfo(implode(' ', $strs)); }
function sayf(...$strs) { say(sprintf(...$strs)); }

function say_notice(...$strs) { logger()->addNotice(implode(' ', $strs)); }
function say_noticef(...$strs) { say_notice(sprintf(...$strs)); }

function say_error(...$strs) { logger()->addError(implode(' ', $strs)); }
function say_errorf(...$strs) { say_error(sprintf(...$strs)); }
function softfatal(...$strs) { say(...$strs); exit(0); }
function fatalf(...$strs) { fatal(sprintf(...$strs)); }
function fatal(...$strs) { 
  say('Fatal:', ...$strs);
  exit(1); 
}
