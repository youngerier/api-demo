<?php

// 商户密钥对
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

const private_key_path = '\doc\a_private.pem';
const public_key_path = '\doc\a_public.pem';

// 连连公钥
const lianlian_public_key_path = '\doc\lianlian_public_key.pem';

// 服务商id
const SP_NO = '602202150000013432';
// 商户id
const MCH_ID = '302201130000010180';

// 签名类型
const sign_type = 'RSA';

define("ROOT_PATH", dirname(__DIR__) . "/");

function Logger(): Logger
{
    $log = new Logger("app");
    $log->pushHandler(new StreamHandler(ROOT_PATH . 'logs/app.log', Logger::DEBUG));
    $log->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
    return $log;
}