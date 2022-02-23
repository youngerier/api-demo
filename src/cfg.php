<?php

// 商户密钥对
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

static $private_key_path = '\doc\a_private.pem';
static $public_key_path = '\doc\a_public.pem';

// 连连公钥
static $lianlian_public_key_path = '\doc\lianlian_public_key.pem';

// 服务商id
static $sp_no = '602202150000013432';
// 商户id
static $mch_id = '302201130000010180';
// 签名类型
static $sign_type = 'RSA';

define("ROOT_PATH", dirname(__DIR__) . "/");

function Logger(): Logger
{
    $log = new Logger("app");
    $log->pushHandler(new StreamHandler(ROOT_PATH . 'logs/app.log', Logger::DEBUG));
    return $log;
}