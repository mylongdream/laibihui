<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => '2018042560065141',

        // 支付宝异步通知地址
        'notify_url' => 'http://zhihui.hztbg.com/api/pay/alipay/notify',

        // 支付成功后同步通知地址
        'return_url' => 'http://zhihui.hztbg.com/api/pay/alipay/callback',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvasBWj+4WNqypgbqtdD4mxxFOeGHtYiWkQCf8JyIxGDi9XgP0x3dN0Est1lWwLPgp88fRsAz8pT/7cd76YRwB51wQPsCL6MKJD5DR/N9yy1d1wLSnMz340McwPHF7Us8JImZJ4zQpeocNBcdm8wIm72SyBBHP0N4dx/ODLzAqQUBTO/YZRDbormUTQmK6tdS7yvXWogbdsqno8s+4KJ06mDFwSoxs4vnv+kYy4y0QEltq2TLVM2lj1GS867zEZTHEvOkXg3Es6OeDdkIuz4xtrtAVFMrwg4QLcEJ2C8yHDlKDN69FyUYB3UvFvvCQLdwn/fpjmP3n4F/o7SYL8d3IwIDAQAB',

        // 自己的私钥，签名时使用
        'private_key' => 'MIIEowIBAAKCAQEAoUL3pV9L1ZwHtrtHQnckBHQgFK5eftQx4pOxWvg4Syl0PLpb1Z6APuFzB5kyqSIbuMDBia6c4dRslPemBkNWYv5WxLo7fiNiycH3KezLvV5A5eYJKXWLXTT6mchGCpSY1yp85O8kH5Rpe3hrWMoAf3ea87bERn70qO/LBO864XwPhRkasGBlv1gRbHde+SZPmfNa4YujFONBaANoWHHqVqitwNe7cQSTZzvTd2l9JNhNnOdD9dSizcVBKBS3QqD0AjxfggpoZ9caEb9UWjuEXklnNWnTWDc1N7HBAUeRgYwGYH33/nhYmVIRu4Qtc6yqS4hy9l+omlldCRIE+u2t2QIDAQABAoIBAHVVqaU9Kot5ZS9zIs1crOtEp1cE7KKxuL5YolJDi4o81mOdYVaUZlHabn0X3gGsXKlYLzoDwAidLIhTjQy/kCqlTvMDYmhMTQPqSvHJZxEZdHUSpJXy/f1KoBCm5TermW3tb0SQMCN+NCXvn4PSLvyQRUGROUzl8RS+rWSgwKHxH9FKENjJvBaCnP5Xoh3+TIPmdAJsvScw+kp7HYcAUaqv6gTb1U7poXAM8+v/eLy/gxsd1uWz9u/6LrsNmx7YSKywZhmCen4NwrkgmVC/bWziNRhsNkTkUzXfcTpaV3nHn1YTEB8IojRlhcb21Pb7KgOB4fGKSubGAwU5nr1KLlECgYEA1DAxLLj7Fluw7PzA7Rogz9Mv6bYkUsyIjA/so4kHVESFqs8W9vAFv5Dmbe3irbCk/kn109St5N5M1lRV4IVta65FN5LCJZHAlnMdR2+1Z3GBaeixEUkCIRdzN9myQrbZzRfvD1j5nsM1kgvHbXv0/ImvY2sRdikY8mGiirUNhlUCgYEAwo7nOF1fthwtbGx3eXV+p3cT+JTdcL3JHZ2B9n7jgnF+1kYT7P62H9+5+hHONVT8e0MnitXPRLrLGwGMWhbdaaAUoAvMBvEUaS4Zzf1C9OlN6e0xG1fr3fCh4WjYh0uW6yrFc8yUWWaTU13Jy73t+JdmMqb9aJQhtEQ7T70BJXUCgYA3uUxAvXebQIsvQZV87v6s9X5At0fEwtgdSFVSATt+gtxDpk0WnqQz0d7iAbYk/R3ndg7sCY99am/tXYqMAx5gSAz/cjgwW52jJSoMR6bxOprM8IIH0w+PFzR392DcKl76gI2Ujz5G1mcsKpG+C+6jn5kC1+xnBpX5mXBxUujxXQKBgAVq91NhfkXS+QzY5GbUd8dwEHVOp+/4yP3zIehcVjeOs4qB/xINccLndwVYs5ZWnIVONG6wT4pJbVh+LYtgsZ+8XnaqfW8ADaJ0LzHGSLQLPykxermZNC9FAS0Gv2jdGQHJeiAkZUksCxQ6O2FaE6Nli+oDLnFYFqwvbjtlNv/1AoGBAIeTRO0dsM49CpLQGZ5DlbtlspduHYngUPR4UWi7i9t0UMMc5OkA2Kcwhc/t+UYmFrK65bkvR0LUxaQ1qiIsk4Pkwo90zdZHjaoHRG9IOf27vYHmTYX6lCh0pbL2wjC3W34XKGfrae8U8giwiG5eKuhbYBFzPLB+44Je9MrSmeCG',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        //     'level' => 'debug'
        ],

        // optional，设置此参数，将进入沙箱模式
        // 'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号APPID
        'app_id' => 'wxa9eee4897a90d290',

        // 小程序APPID
        'miniapp_id' => 'wx2ba50d1e3b8bb094',

        // APP 引用的 appid
        'appid' => 'wxa9eee4897a90d290',

        // 微信支付分配的微信商户号
        'mch_id' => '1457768302',

        // 微信支付异步通知地址
        'notify_url' => 'http://yansongda.cn/wechat_notify.php',

        // 微信支付签名秘钥
        'key' => 'mF2suE9sU6Mkxxxxxxx5645645',

        // 客户端证书路径，退款时需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => storage_path('app/wechat/cert/apiclient_cert.pem'),

        // 客户端秘钥路径，退款时需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => storage_path('app/wechat/cert/apiclient_key.pem'),

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
        //     'level' => 'debug'
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
        // 'mode' => 'dev',
    ],
];
