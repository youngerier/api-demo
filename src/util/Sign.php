<?php

namespace ziggle\demo\util;


class Sign
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
        $private_key = self::_get_pem_content(private_key_path);
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
     * @param $signature 数字签名
     * @return -1:error验证错误 1:correct验证成功 0:incorrect验证失败
     */
    public static function isValid($data = '', $signature = '')
    {
        if (empty($data) || empty($signature)) {
            return False;
        }

        $public_key = self::_get_pem_content(public_key_path);
        if (empty($public_key)) {
            echo "Public Key error!";
            return False;
        }

        $pkeyid = openssl_get_publickey($public_key);
        if (empty($pkeyid)) {
            echo "public key resource identifier False!";
            return False;
        }

        $ret = openssl_verify($data, $signature, $pkeyid, OPENSSL_ALGO_MD5);
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

    private static function _get_pem_content($file_path)
    {
        return file_get_contents(dirname(__FILE__, 3) . $file_path);
    }


    public static function enc(string $data): string
    {
        $rsa = new Rsa(private_key_path, lianlian_public_key_path);
        return $rsa->publicEncrypt($data);
    }
}