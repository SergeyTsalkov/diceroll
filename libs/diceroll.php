<?php

function diceroll($string) {
  $parts = preg_split('/([+-])/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);

  // figure out which random numbers we need
  $need_random = [];
  foreach ($parts as $part) {
    if (!preg_match('/(\d+)?d(\d+)/', $part, $match)) continue;

    $max = intval($match[2]);
    $count = intval($match[1]);
    if ($count < 1) $count = 1;

    $need_random[$max] += $count;
  }

  // get random numbers
  $random = random($need_random);

  // use random numbers to generate intermediate string and result
  $intermediate = [];
  $result = 0;
  $add = true;
  foreach ($parts as &$part) {
    $part = trim($part);

    if (preg_match('/(\d+)?d(\d+)/', $part, $match)) {
      $max = intval($match[2]);
      $count = intval($match[1]);
      if ($count < 1) $count = 1;

      $rands = [];
      for ($i = 0; $i < $count; $i++) {
        if (count($random[$max]) < 1) throw new Exception("Unable to parse: not enough random numbers");
        $rands[] = array_shift($random[$max]);
      }

      if (!is_bool($add)) throw new Exception();
      if ($add) $result += array_sum($rands);
      else $result -= array_sum($rands);
      $add = null;

      if (count($rands) == 1) {
        $intermediate[] = sprintf('[%s]', $rands[0]);
      } else if (count($rands) > 1) {
        $intermediate[] = '(' . implode('+', array_map(fn($rand) => "[{$rand}]", $rands)) . ')';
      }

    } else if (is_numeric($part)) {
      if (!is_bool($add)) throw new Exception();
      $part = intval($part);
      $intermediate[] = $part;

      if ($add) $result += $part;
      else $result -= $part;
      $add = null;

    } else if ($part == "+") {
      if (is_bool($add)) throw new Exception();
      $intermediate[] = $part;
      $add = true;
    } else if ($part == "-") {
      if (is_bool($add)) throw new Exception();
      $intermediate[] = $part;
      $add = false;
    }

  }

  return [
    'intermediate' => implode(' ', $intermediate),
    'result' => $result,
  ];
}

function random(array $requests): array {
  $Guzzle = new GuzzleHttp\Client(['timeout' => 10]);

  $random = [];
  foreach ($requests as $max => $count) {
    if ($waitfor) {
      usleep($waitfor * 1000);
    }

    $result = $Guzzle->request('POST', 'https://api.random.org/json-rpc/4/invoke', [
      'json' => [
        'jsonrpc' => '2.0',
        'method' => 'generateIntegers',
        'id' => 1,
        'params' => [
          'apiKey' => RANDOM_ORG_API_KEY,
          'n' => $count,
          'min' => 1,
          'max' => $max,
        ],
      ],
    ]);

    $json = json_decode($result->getBody(), true);
    if (! $json) throw new Exception($result->getBody());

    $random[$max] = $json['result']['random']['data'];
    $waitfor = $json['result']['advisoryDelay'];
  }

  return $random;
}