<?php
require '../vendor/autoload.php';

use demo\params\UploadDocumentRequest;
use function demo\util\check_sign;
use function demo\util\httpPost;
use function demo\util\sign_data;

require 'params/PayApply.php';
require 'util/Http.php';


function upload_file()
{
    $e = new UploadDocumentRequest();
    $e->user_no = "1234";
    $e->txn_seqno = date("YmdHis");
    $e->txn_time = date("YmdHis");
    $e->file_type = "png";
    $e->context_type = "UBO_IMAGE";
    $e->file_context = "bb";

    httpPost('https://test.lianlianpay-inc.com/merchant/v1/file/uploadfile', json_encode($e));
}

/**
 * 签名
 * @return void
 */
function test_sign()
{
    $data = "xxxxx";
    echo sign_data($data) . PHP_EOL;
}

function test_check_sign()
{
    $data = "xxxxx";
    $sign_data = 'VGbqtHw+mGsHpkuZni7pIXVdtNDkCbfb+yToSBFSsCWAXN58FEe2Gzq8RXRZfZgmCmqafaGxF3ca2S9BoFqll5+zVwvkLY821s0rDj1iri499yghwRyemwDBjr7M1388lF8HelaJgj1NCo1uhVhUuSd4LoRHVO3NjpyLMFWE/EM=';
    echo check_sign($data, $sign_data) . PHP_EOL;
}

/**
 * RSA 加密
 */

upload_file();
//test_sign();
//test_check_sign();