<?php

class Rsa
{
    private $PriKye;
    private $PubKey;

    public function __construct($pri_key_path, $pub_key_path)
    {
        $this->PriKye = $this->_getRsaPriKey($pri_key_path);
        $this->PubKey = $this->_getRsaPubKey($pub_key_path);
    }

    /**
     * RSA私钥加密
     * @param string $private_key 私钥
     * @param string $data 要加密的字符串
     * @return string $encrypted 返回加密后的字符串
     * @author mosishu
     */
    public function privateEncrypt($data)
    {
        $encrypted = '';
        $pi_key = openssl_pkey_get_private($this->PriKye);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        //最大允许加密长度为117，得分段加密
        $plainData = str_split($data, 100);//生成密钥位数 1024 bit key
        foreach ($plainData as $chunk) {
            $partialEncrypted = '';
            $encryptionOk = openssl_private_encrypt($chunk, $partialEncrypted, $pi_key);//私钥加密
            if ($encryptionOk === false) {
                return false;
            }
            $encrypted .= $partialEncrypted;
        }

        $encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $encrypted;
    }


    /**
     * RSA公钥解密(私钥加密的内容通过公钥可以解密出来)
     * @param string $public_key 公钥
     * @param string $data 私钥加密后的字符串
     * @return string $decrypted 返回解密后的字符串
     * @author mosishu
     */
    public function publicDecrypt(string $data)
    {
        $decrypted = '';

        $pu_key = openssl_pkey_get_public($this->PubKey);//这个函数可用来判断公钥是否是可用的
        $plainData = str_split(base64_decode($data), 128);//生成密钥位数 1024 bit key
        foreach ($plainData as $chunk) {
            $str = '';
            $decryptionOk = openssl_public_decrypt($chunk, $str, $pu_key);//公钥解密
            if ($decryptionOk === false) {
                return false;
            }
            $decrypted .= $str;
        }
        return $decrypted;
    }


    //RSA公钥加密
    public function publicEncrypt($data)
    {
        $encrypted = '';
        $pu_key = openssl_pkey_get_public($this->PubKey);
        $plainData = str_split($data, 100);
        foreach ($plainData as $chunk) {
            $partialEncrypted = '';
            $encryptionOk = openssl_public_encrypt($chunk, $partialEncrypted, $pu_key);//公钥加密
            if ($encryptionOk === false) {
                return false;
            }
            $encrypted .= $partialEncrypted;
        }
        $encrypted = base64_encode($encrypted);
        return $encrypted;
    }


    //RSA私钥解密
    public function privateDecrypt($data)
    {
        $decrypted = '';
        $pi_key = openssl_pkey_get_private($this->PriKye);
        $plainData = str_split(base64_decode($data), 128);
        foreach ($plainData as $chunk) {
            $str = '';
            $decryptionOk = openssl_private_decrypt($chunk, $str, $pi_key);//私钥解密
            if ($decryptionOk === false) {
                return false;
            }
            $decrypted .= $str;
        }
        return $decrypted;
    }

    /**
     * 获取Rsa私钥
     *
     * @return string
     */
    private function _getRsaPriKey(string $pri_key_path): string
    {
        return self::_get_pem_content($pri_key_path);
    }

    private function _getRsaPubKey(string $pub_key_path): string
    {
        return self::_get_pem_content($pub_key_path);
    }

    private static function _get_pem_content($file_path)
    {
        return file_get_contents(dirname(__FILE__, 3) . $file_path);
    }

}
