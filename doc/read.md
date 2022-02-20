# 生成私钥

`openssl genrsa -out app_private_key.pem   2048 `

# Java开发者需要将私钥转换成PKCS8格式

`openssl pkcs8 -topk8 -inform PEM -in app_private_key.pem -outform PEM -nocrypt -out app_private_key_pkcs8.pem`

# 生成公钥

`openssl rsa -in app_private_key.pem -pubout -out app_public_key.pem`





