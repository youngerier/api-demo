<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET',
    'https://api.github.com/repos/guzzle/guzzle', ['verify' => false]);

echo $response->getStatusCode() . PHP_EOL; // 200
echo $response->getHeaderLine('content-type') . PHP_EOL; // 'application/json; charset=utf8'
echo $response->getBody() . PHP_EOL; // '{"id": 1420053, "name": "guzzle", ...}'

