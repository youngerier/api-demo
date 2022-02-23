<?php

namespace ziggle\demo\tests;

use PHPUnit\Framework\TestCase;
use ziggle\demo\params\PaymentApplyReqVo;
use ziggle\demo\util\Sign;

require '..\src\cfg.php';
require '..\src\util\Http.php';

class App extends TestCase
{
    public function testRetriesWhenDeciderReturnsTrue()
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
}