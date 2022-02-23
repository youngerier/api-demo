<?php

namespace ziggle\demo\params;
class RefundApplyReqVo
{
    /**
     * 商户编号
     */
    public string $mch_id;

    /**
     * 商户退款订单唯一号 不能有中文
     */
    public string $refund_seqno;
    /**
     * 商户退款时间
     */
    public string $refund_time;
    /**
     * 商户原支付订单唯一号 不能有中文
     */
    public string $txn_seqno;
    /**
     * 退款原因描述
     */
    public string $refund_reason;
    /**
     * 退款金额
     */
    public string $refund_amount;
    /**
     * 异步通知地址
     */
    public string $notify_url;

    /**
     * 退款明细
     */
    public array $refund_details;
}