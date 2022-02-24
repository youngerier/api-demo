api-demo
├─ .gitignore
├─ composer.json
├─ doc           -- 公/私钥
│  ├─ a_private.pem
│  ├─ a_public.pem
│  ├─ lianlian_public_key.pem
│  └─ read.md
├─ read.md
├─ src
│  ├─ cfg.php    -- 基础配置
│  ├─ index.php
│  ├─ params     -- 请求参数模型类
│  │  ├─ GoodsInfoVo.php
│  │  ├─ PayApplyReqVo.php
│  │  ├─ PaymentApplyReqVo.php
│  │  ├─ PaymentQueryReqVo.php
│  │  ├─ PayQueryReqVo.php
│  │  ├─ RefundApplyReqVo.php
│  │  ├─ RefundDetailVo.php
│  │  ├─ RefundQueryReqVo.php
│  │  ├─ ShareInfoVo.php
│  │  ├─ ShareListVo.php
│  │  └─ UploadDocumentRequest.php
│  └─ util
│     ├─ Http.php
│     ├─ Rsa.php
│     └─ Sign.php
└─ tests
   └─ App.php   -- 测试方法入口