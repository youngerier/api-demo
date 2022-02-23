<?php
require '../vendor/autoload.php';

use ziggle\demo\params\GoodsInfoVo;
use ziggle\demo\params\PayApplyReqVo;
use ziggle\demo\params\PaymentApplyReqVo;
use ziggle\demo\params\RefundApplyReqVo;
use ziggle\demo\params\RefundDetailVo;
use ziggle\demo\params\ShareInfoVo;
use ziggle\demo\params\ShareListVo;
use ziggle\demo\params\UploadDocumentRequest;
use ziggle\demo\util\Rsa;
use ziggle\demo\util\Sign;

require 'cfg.php';
require 'params/UploadDocumentRequest.php';
require 'util/Http.php';
require 'util/Rsa.php';

/**
 * 文件上传
 * @return void
 */
function test_upload_file()
{
    $e = new UploadDocumentRequest();
    $e->user_no = "1234";
    $e->txn_seqno = date("YmdHis");
    $e->txn_time = date("YmdHis");
    $e->file_type = "png";
    $e->context_type = "UBO_IMAGE";
    $e->file_context = "bb"; // base64处理文件

    httpPost('https://test.lianlianpay-inc.com/merchant/v1/file/uploadfile', json_encode($e));
}

/**
 * 付款接口
 *
 * @return void
 *
 */
function test_payment()
{
    $req = new PaymentApplyReqVo();
    $req->mch_id = MCH_ID;
    $req->txn_seqno = date("YmdHis");
    $req->txn_time = date("YmdHis");
    $req->order_amount = "0.1";
    $req->acct_name = Sign::enc("李三"); // 属性加密
    $req->order_info = "test order info ";
    $req->card_no = Sign::enc("6228480223312311474");  // 属性加密
    $req->memo = "memo";
    $req->flag_card = "PRIVATE_CASH";
    $req->risk_item = "{\"frms_ware_category\":\"2009\",\"user_info_mercht_userno\":\"12345\",\"user_info_bind_phone\":\"13812345678\",\"user_info_dt_register\":\"20141015165530\",\"user_info_full_name\":\"张三丰\",\"user_info_id_no\":\"3306821990012121221\",\"user_info_identify_type\":\"1\",\"user_info_identify_state\":\"1\",\"user_info_id_type\":\"0\",\"frms_client_chnl\":\"10\",\"frms_ip_addr\":\"60.191.76.226\"}";
    $req->notify_url = "http://localhost:9090";
    $req->bank_code = "99990001";
    $req->prcptcd = "102308001068";
    $req->city_code = "";
    $req->brabank_name = "中国农业银行";

    $resp = httpPost('https://test.lianlianpay-inc.com/mpay-openapi/v1/ipay/cashout/payment/apply', json_encode($req));
    Logger()->info($resp);
}

/**
 * 支付申请
 * @return void
 */
function test_wechat_ali_pay_apply()
{
    $goodsInfoVo = new GoodsInfoVo();
    $goodsInfoVo->goods_name = "test goods name";
    $share_info = new ShareInfoVo();
    $shareListVo = new ShareListVo();
    $shareListVo->share_uid = "201608110000196145";
    $shareListVo->share_amount = "1";
    $shareListVo->share_memo = "分账描述";
    $share_info->share_list = array($shareListVo);

    $req = new PayApplyReqVo();
    $req->mch_id = MCH_ID;
    $req->user_id = "202112021358109530";
    $req->txn_seqno = date("YmdHis");
    $req->txn_time = date("YmdHis");
    $req->order_amount = "5";
    $req->goods_info = $goodsInfoVo;
    $req->user_ip = "10.20.232.58";
    $req->order_info = "test order info";
    $req->pay_expire = "600";
    $req->share_info = $share_info;
    $req->pay_type = "WX_SCAN"; // 参考支持的支付方式
    $req->risk_item = "{\"frms_ware_category\":\"2009\",\"user_info_mercht_userno\":\"12345\",\"user_info_bind_phone\":\"13812345678\",\"user_info_dt_register\":\"20141015165530\",\"user_info_full_name\":\"张三丰\",\"user_info_id_no\":\"3306821990012121221\",\"user_info_identify_type\":\"1\",\"user_info_identify_state\":\"1\",\"user_info_id_type\":\"0\",\"frms_client_chnl\":\"10\",\"frms_ip_addr\":\"60.191.76.226\"}";
    $req->extend_info = "{\"appid\":\"wx24f0a46b15545374\",\"openid\":\"oUpF8uNC0x27mr4fkcf2p0Hm1vIQ\"}";
    $req->notify_url = "http://localhost:9090/notify";

    $resp = httpPost('https://test.lianlianpay-inc.com/mpay-openapi/v1/ipay/cashin/wechatali/apply', json_encode($req));
    Logger()->info($resp);
}

function test_refund()
{
    $refundDetailVo = new RefundDetailVo();
    $refundDetailVo->refund_mch_id = "201608110000196145";
    $refundDetailVo->refund_amount = "0.1";

    $req = new RefundApplyReqVo();
    $req->mch_id = MCH_ID;
    $req->refund_seqno = date("YmdHis");;
    $req->refund_time = date("YmdHis");;
    $req->txn_seqno = "202111081131043299";;
    $req->refund_reason = "reason";
    $req->refund_amount = "0.1";
    $req->notify_url = "http://localhost:9090/notify";
    $req->refund_details = array($refundDetailVo);

    $resp = httpPost('https://test.lianlianpay-inc.com/mpay-openapi/v1/ipay/cashin/refund/apply', json_encode($req));
    Logger()->info($resp);
}

/**
 * 付款查询
 * @return void
 */
function test_payment_query()
{
    $req = new PaymentApplyReqVo();
    httpPost('https://test.lianlianpay-inc.com/merchant/v1/file/uploadfile', json_encode($req));
}


/**
 * 签名
 * @return void
 */
function test_sign()
{
    $data = "xxxxx";
    $sign_data = sign_data($data);
    echo $sign_data . PHP_EOL;
}


/**
 * 数据加密
 * @return void
 */
function test_enc()
{

    $data = "xdaaa";
    $rsa= new Rsa(private_key_path, public_key_path);
    $encode_data = $rsa->publicEncrypt($data);
    echo $encode_data . PHP_EOL;
    $source = $rsa->privateDecrypt($encode_data);
    echo $source . PHP_EOL;
}


/**
 * RSA 加密
 */

//test_upload_file();
//test_sign();
//test_enc();
//test_payment();
//test_wechat_ali_pay_apply();
