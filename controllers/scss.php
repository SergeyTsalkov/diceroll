<?php
use ScssPhp\ScssPhp\Compiler;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
class SCSSController extends SlimController {
  function show(Request $Req, Response $Resp, array $args) {
    $filename = SCSS_DIR . '/' . str_replace('.css', '.scss', $args['filename']);
    if (! file_exists($filename)) die("Missing CSS file");
    $data = file_get_contents($filename);
    $SCSS = new Compiler();
    $SCSS->setImportPaths(SCSS_DIR);
    $SCSS->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
    // cache settings handled by apache expires module
    return $Resp
      ->withHeader('Content-Type', 'text/css')
      //->withHeader('Cache-Control', 'max-age=' . Time::HOUR)
      //->withHeader('Expires', gmdate('D, d M Y H:i:s T', time() + 6 * Time::HOUR))
      ->withoutHeader('Pragma')
      ->write($SCSS->compile($data));
  }
}