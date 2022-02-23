<?php

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use ziggle\demo\util\Sign;

require 'Sign.php';

function httpPost($url, $content): StreamInterface
{

    Logger()->info("req_url: " . $url);
    Logger()->info("req_body: " . $content);

    $client = new Client();
    $header = [
        'timestamp' => date("YmdHis"),
        'Signature-Data' => sign_data($content),
        'Signature-Type' => sign_type,
        'sp_no' => SP_NO,
        'Content-Type' => 'application/json;charset=UTF-8',
    ];
    $response = $client->post($url,
        [
            'body' => $content,
            'headers' => $header,
            'verify' => false
        ]);
    Logger()->info("req_header: " . json_encode($header));
    Logger()->info("resp_body: " . $response->getBody());

    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            if ($name == 'Signature-Data') {
                Logger()->info(sprintf('%s: %s', $name, $value));
                // 验签
                $stream = md5($response->getBody(),false);
                $isValid = Sign::isValid($stream, $value);
                Logger()->info(sprintf('验签结果: %s', $isValid));
            }
        }
    }
    return $response->getBody();
}


function sign_data($content): string
{
    $md5Sign = md5($content);
    $sign_data = Sign::sign($md5Sign);
    return base64_encode($sign_data);
}
