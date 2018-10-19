<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
	protected $table = 'payment';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['creat_time'];

    public function user(){
        return $this->belongsTo('App\Models\CommonUserModel', 'user_id', 'uid');
    }

    public function card_order(){
        return $this->hasOne('App\Models\CommonCardOrderModel', 'source_sn', 'order_sn');
    }

    /**
     *
     * 创建支付单，支付所有类型支付创建
     *
     * 报错码按照type来识别，比如商城类，无会员 return -1001
     * 
     * @param [必填]pay_stype：来源类型[1:商城支付单,2:入库单]
     * @param [必填]source_sn：来源流水号，通过支付单类型二次复验
     * @param [必填]member_id：会员ID
     * @param [必填]api_label：支付类型
     * @param [必填]total_amount：支付单总金额
     * @param remark：支付单备注
     * @param opname：操作人
     *
     *
     * @return payment_id，新增,sn，序列号
     * 
     */
    public function add_data($inData = array()){
        // --------------------------------------------------------------------
        /**
         *
         * 基础信息过滤
         *
         * @return  -1000：来源类型
         * @return  -1001：会员不存在
         * @return  -1002：来源编码不存在
         * @return  -1003：支付方式不存在
         * @return  -1004：支付金额错误
         * 
         */
        $inDb = array();
        
        //来源类型
        if (empty($inData['type'])){
            return -1000;
        }
        $inDb['type'] =  $inData['type'];

        //来源编码&不判断重复
        if (empty($inData['source_sn'])) {
            return -2000;
        }
        $inDb['source_sn'] =  trim($inData['source_sn']);

        //支付金额
        if (empty($inData['total_amount'])) {
            return -3000;
        }

        //为了兼容积分全部抵扣
        $inDb['payed_amount'] = 0;
        if(!empty($inData['payed_amount']) && $inData['payed_amount'] > 0){
            $inDb['payed_amount'] = $inData['payed_amount'];
        }

        $inDb['total_amount'] = (float)$inData['total_amount'];
        $inDb['nopay_amount'] = $inDb['total_amount'] - $inDb['payed_amount'];

        //基础信息
        $inDb['creat_time']     =  time();  //入库时间
        $inDb['status']         =  '100';     //入库状态
        $inDb['remark']         =  !empty($inData['remark']) ? $inData['remark'] : NULL;         //总金额
        $opname                 =  !empty($inData['opname']) ? $inData['opname'] : 'system';     //操作人
        // $inDb['sn']             =  gs_sn('PAY');
        

        // --------------------------------------------------------------------
        /**
         *
         * 创建支付单，
         *
         */
        switch ($inDb['type']) {

            //  购买卡
            case '1':
                //类型[应收]
                $inDb['pay_type'] = 1;

                //支付类型，payment_api，ID
                if (empty($inData['payment_api'])) {
                    return -4000;
                }
                $inDb['payment_api'] =  $inData['payment_api'];

                // 判断购买记录是否存在
                $order = DB::table('common_card_order')->where('order_sn', $inDb['source_sn'])->get();
                if ($order->isEmpty()) {
                    return -5000;
                }
            break;

            // 消费
            case '2':

                break;

            default:
                return false;
            break;
        }

        // //金额正负
        // if ($inDb['pay_type'] == 2) {
        //     //应付
        //     $inDb['total_amount'] = - $inDb['total_amount'];
        //     $inDb['nopay_amount'] = - $inDb['total_amount'];
        // }
        // else{
        //     //应收
        //     $inDb['total_amount'] = $inDb['total_amount'];
        //     $inDb['nopay_amount'] = $inDb['total_amount'];
        // }

        //新增后返回自增ID，和SN
        $returnArr = NULL;

        $add_id = PaymentModel::create($inDb);

        // 已支付
        if ($inDb['nopay_amount'] <= 0) {
            $this->pay_done($inDb);
        }

        return $add_id;
    }

    /**
     *
     * 支付单支付成功，进行相关逻辑通知
     *
     * [传值]订单明细 
     * 
     */
    public function pay_done($rc = array()){
        //通知不同类型订单
        switch ($rc['type']) {
            // TODO 办卡
            case '1':
                
                break;

            // TODO 消费
            case '2':

                break;

            default:
                # code...
                break;
        }

        // 更新支付单
        PaymentModel::where(['id' => $rc['id']])->update(['nopay_amount' => 0, 'payed_amount' => $rc['total_amount']
            , 'pay_time' => time(), 'status' => '2']);
    }    
}