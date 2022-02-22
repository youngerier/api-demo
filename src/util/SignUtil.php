<?php

namespace demo\util;


class SignUtil
{

    /**
     * 利用约定数据和私钥生成数字签名
     * @param $data 待签数据
     * @return String 返回签名
     */
    public static function sign($data = '')
    {
        if (empty($data)) {
            return False;
        }
        $private_key = file_get_contents(dirname(__FILE__, 3) . '\doc\a_private.pem');
        if (empty($private_key)) {
            echo "Private Key error!";
            return False;
        }

        $pkeyid = openssl_get_privatekey($private_key);
        if (empty($pkeyid)) {
            echo "private key resource identifier False!";
            return False;
        }
        $verify = openssl_sign($data, $signature, $pkeyid, OPENSSL_ALGO_MD5);
        return $signature;
    }

    /**
     * 利用公钥和数字签名以及约定数据验证合法性
     * @param $data 待验证数据
     * @param $pub_key 数字签名
     * @return -1:error验证错误 1:correct验证成功 0:incorrect验证失败
     */
    public static function isValid($data = '', $pub_key = '')
    {
        if (empty($data) || empty($pub_key)) {
            return False;
        }

        $public_key = file_get_contents(dirname(__FILE__,3) . '\doc\a_public.pem');
        if (empty($public_key)) {
            echo "Public Key error!";
            return False;
        }

        $pkeyid = openssl_get_publickey($public_key);
        if (empty($pkeyid)) {
            echo "public key resource identifier False!";
            return False;
        }

        $ret = openssl_verify($data, $pub_key, $pkeyid, OPENSSL_ALGO_MD5);
        switch ($ret) {
            case -1:
                echo "error";
                break;
            default:
                echo $ret == 1 ? "correct" : "incorrect";//0:incorrect
                break;
        }
        return $ret;
    }

}