<?php
require 'SignUtil.php';

use GuzzleHttp\Client;
use Muyue\ApiDemo\util\SignUtil;

$sp_no = '602202150000013432';
$sign_type = 'RSA';

function httpPost($url, $content)
{
    global $sp_no;
    global $sign_type;

    echo $url . PHP_EOL;
    echo $content . PHP_EOL;

    $client = new Client();
    $response = $client->post($url,
        [
            'body' => $content,
            'headers' => [
                'timestamp' => date("'YmdHis"),
                'Signature-Data' => sign_data($content),
                'Signature-Type' => $sign_type,
                'sp_no' => $sp_no,
                'Content-Type' => 'application/json;charset=UTF-8',
            ],
            'verify' => false
        ]);
    echo $response->getBody() . PHP_EOL;
}


function sign_data($content): string
{
    $md5Sign = md5($content);
    $sign_data = SignUtil::sign($md5Sign);
    return base64_encode($sign_data);
}

function check_sign($data, $signature)
{
    return SignUtil::isValid($data, $signature);
}