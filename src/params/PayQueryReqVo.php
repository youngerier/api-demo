<?php
namespace ziggle\demo\params;

class PayQueryReqVo
{
    /**
     * 商户编号
     */
    public string $mch_id;


    /**
     * 商户唯一订单号 商户系统唯一订单号
     */
    public string $txn_seqno;
}