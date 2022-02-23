<?php

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use ziggle\demo\util\Sign;

require 'Sign.php';

function httpPost($url, $content): StreamInterface
{
    global $sp_no;
    global $sign_type;

    echo "req_url: " . $url . PHP_EOL;
    echo "req_body: " . $content . PHP_EOL;

    $client = new Client();
    $header = [
        'timestamp' => date("YmdHis"),
        'Signature-Data' => sign_data($content),
        'Signature-Type' => $sign_type,
        'sp_no' => $sp_no,
        'Content-Type' => 'application/json;charset=UTF-8',
    ];
    $response = $client->post($url,
        [
            'body' => $content,
            'headers' => $header,
            'verify' => false
        ]);
    echo "req_header: " . json_encode($header). PHP_EOL;
    echo "resp_body: " . $response->getBody() . PHP_EOL;
    return $response->getBody();
}


function sign_data($content): string
{
    $md5Sign = md5($content);
    $sign_data = Sign::sign($md5Sign);
    return base64_encode($sign_data);
}
