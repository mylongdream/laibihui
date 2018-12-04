<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::replacer('display_min', function($message, $attribute, $rule, $parameters) {
            return str_replace([':display_min'], $parameters, $message);
        });
        Validator::replacer('display_max', function($message, $attribute, $rule, $parameters) {
            return str_replace([':display_max'], $parameters, $message);
        });
        Validator::extend('display_min', function ($attribute, $value, $parameters, $validator) {
            // 计算单字节.
            preg_match_all('/[a-zA-Z0-9_]/', $value, $single);
            $single = count($single[0]);
            // 多子节长度.
            $double = mb_strlen(preg_replace('([a-zA-Z0-9_])', '', $value)) * 2;
            $length = $single + $double;
            return $length >= array_first($parameters);
        });
        Validator::extend('display_max', function ($attribute, $value, $parameters, $validator) {
            // 计算单字节.
            preg_match_all('/[a-zA-Z0-9_]/', $value, $single);
            $single = count($single[0]);
            // 多子节长度.
            $double = mb_strlen(preg_replace('([a-zA-Z0-9_])', '', $value)) * 2;
            $length = $single + $double;
            return $length <= array_first($parameters);
        });
        Validator::extend('username_rule', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $value);
        });
        Validator::extend('password_rule', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?![\d]+$)(?![a-zA-Z]+$)(?![^\da-zA-Z]+$).{6,14}$/', $value);
        });
        Validator::extend('captcha_check', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, session('captcha.key'));
        });
        Validator::extend('password_check', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });
        Validator::extend('zh_mobile', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[3678]|18\d)\d{8}|170[059]\d{7})$/', $value);
        });
        Validator::extend('confirm_mobile_not_change', function ($attribute, $value, $parameters, $validator) {
            $smscode = session('smscode');
            return !$smscode || ($smscode && $smscode['mobile'] === $value);
        });
        Validator::extend('verify_code', function ($attribute, $value, $parameters, $validator) {
            $smscode = session('smscode');
            return $smscode && $smscode['deadline'] >= time() && $smscode['code'] === $value;
        });
        //扩展身份证验证规则
        Validator::extend('identitycards', function($attribute, $value, $parameters) {
            return preg_match('/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)/', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
