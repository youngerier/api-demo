<?php
namespace ziggle\demo\params;

class UploadDocumentRequest
{
    public string $user_no;
    public string $txn_seqno;
    public string $txn_time;
    public string $file_type;
    public string $context_type;
    public string $file_context;
}