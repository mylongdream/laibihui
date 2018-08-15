<?php

namespace App\Http\Controllers\Api\AliPay;

use App\Http\Controllers\Controller;
use App\Models\BrandConsumeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yansongda\Pay\Exceptions\Exception;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

class ConsumeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function callback(Request $request)
    {
        $config = config('pay.alipay');
        $config['notify_url'] = route('api.alipay.consume.notify');
        $config['return_url'] = route('api.alipay.consume.callback');
        $alipay = Pay::alipay($config);
        try{
            $data = $alipay->verify();
            $order = BrandConsumeModel::where('order_sn', $data->out_trade_no)->first();
            if($order){
                $order->ifpay = 1;
                $order->pay_at = Carbon::now();
                $order->save();
            }


            dd('success');

            Log::debug('Alipay notify', $data->all());


        } catch (Exception $e) {
            // $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function notify(Request $request)
    {
        $config = config('pay.alipay');
        $config['notify_url'] = route('api.alipay.consume.notify');
        $config['return_url'] = route('api.alipay.consume.callback');
        $alipay = Pay::alipay($config);
        try{
            $data = $alipay->verify();
            $order = BrandConsumeModel::where('order_sn', $data->out_trade_no)->first();
            if($order){
                $order->ifpay = 1;
                $order->pay_at = Carbon::now();
                $order->save();
            }



            dd('success');


            Log::debug('Alipay notify', $data->all());

        } catch (Exception $e) {
            // $e->getMessage();
        }
        return $alipay->success()->send();
    }
}
