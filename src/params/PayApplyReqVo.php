<?php

namespace ziggle\demo\params;


class PayApplyReqVo
{

    /**
     * 商户编号
     */
    public string $mch_id;

    /**
     * 用户ID
     */

    public string $user_id;

    /**
     * 商户唯一订单号
     */
    public string $txn_seqno;

    /**
     * 商户订单时间 格式：YYYYMMDDH24MISS 14位数字，精确到秒
     */
    public string $txn_time;

    /**
     * 交易金额 该笔订单的资金总额，单位为RMB-元。大于0的数字，精确到小数点后两位。如：49.65
     */
    public string $order_amount;

    /**
     * 商品名称
     */
    public GoodsInfoVo $goods_info;

    /**
     * 商户的用户设备ip
     */
    public string $user_ip;

    /**
     * 订单描述 说明付款用途，5W以上必传
     */
    public string $order_info;

    /**
     * 订单有效时间 分钟为单位，默认为10080分钟（7天），
     */
    public ?string $pay_expire;

    /**
     * 分账信息,最多支持三个分账商户,分账参数说明请查看分账参数章节
     */
    public ShareInfoVo $share_info;

    /**
     * 支付方式
     */
    public string $pay_type;

    /**
     * 风险控制参数
     */
    public string $risk_item;

    /**
     * 微信支付参数合集
     */
    public string $extend_info;

    /**
     * 异步通知地址
     */
    public string $notify_url;

}