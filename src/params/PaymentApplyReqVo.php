<?php
namespace ziggle\demo\params;


class PaymentApplyReqVo
{

    /**
     * 商户编号
     */
    public $mch_id;

    /**
     * 商户唯一订单号 商户系统唯一订单号
     */
    public $txn_seqno;
    /**
     * 商户订单时间 格式：YYYYMMDDH24MISS 14位数字，精确到秒
     */
    public $txn_time;
    /**
     * 交易金额 该笔订单的资金总额，单位为RMB-元。大于0的数字，精确到小数点后两位。如：49.65
     */
    public $order_amount;


    /**
     * 收款方姓名
     */
    public $acct_name;

    /**
     * 订单描述 5W 以上必传
     */
    public $order_info;

    /**
     * 收款方银行账号
     * 分期码位token
     */
    public $card_no;


    public $memo;

    /**
     * 对公对私标志
     * 0 - public 对私
     * 1 - PUBLIC 对公
     * TOKEN - TOKEN 分期码
     */
    public $flag_card;

    /**
     * 风险控制参数
     */
    public $risk_item;

    /**
     * 异步通知地址
     */
    public $notify_url;

    /**
     * 银行编码
     */
    public $bank_code;

    /**
     * 大额行号
     */

    public $prcptcd;

    /**
     * 开户行所在省市编码
     */

    public $city_code;

    /**
     * 开户支行名称
     */
    public $brabank_name;

}


