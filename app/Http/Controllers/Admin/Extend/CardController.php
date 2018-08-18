<?php

namespace App\Http\Controllers\Admin\Extend;

use App\Http\Controllers\Controller;
use App\Models\CommonCardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $CommonCardModel = new CommonCardModel;
        $cards = $CommonCardModel->where(function($query) use($request) {
            if($request->bind == 1){
                $query->has('user');
            }elseif($request->bind == 2){
                $query->has('allot');
            }else{
                $query->doesntHave('user')->doesntHave('allot');
			}
        })->where(function($query) use($request) {
            if($request->prefix){
                $query->where('number', 'like',$request->prefix."%");
            }
        })->latest()->orderBy('number', 'desc')->paginate(20);
        return view('admin.extend.card.index', ['cards' => $cards]);
    }


    public function export(Request $request)
    {
        if($request->isMethod('POST')){
            $rules = array(
                'prefix' => 'required|max:10',
                'count' => 'required|numeric|max:10000',
            );
            $messages = array(
                'prefix.required' => '卡号前缀不允许为空！',
                'prefix.max' => '卡号前缀必须小于 :max 个字符。',
                'count.required' => '生成数量不允许为空！',
                'count.numeric' => '生成数量必须是数值。',
                'count.max' => '生成数量必须小于 :max 个字符。',
            );
            $this->validate($request, $rules, $messages);

            $count = intval($request->count);
            $count = $count < 1 ? 1 : $count;
            $count = $count > 10000 ? 10000 : $count;

            $CommonCardModel = new CommonCardModel;
            $cardlist = $CommonCardModel->where(function($query) use($request) {
                if($request->bind == 1){
                    $query->has('user');
                }elseif($request->bind == 2){
                    $query->has('allot');
                }else{
                    $query->doesntHave('user')->doesntHave('allot');
                }
            })->where(function($query) use($request) {
                if($request->prefix){
                    $query->where('number', 'like',$request->prefix."%");
                }
            })->latest()->orderBy('number', 'desc')->get()->take($count);
            $cardData[] = ['卡号', '密码'];
            foreach ($cardlist as $key => $value) {
                $cardData[] = [$value['number'], $value['password']];
            }
            Excel::create('消费卡密',function($excel) use ($cardData){
                $excel->sheet('card', function($sheet) use ($cardData){
                    $sheet->rows($cardData);
                });
            })->export('xls');
            return false;
        }else{
            return view('admin.extend.card.export');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extend.card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'length' => 'required|numeric|max:20',
            'prefix' => 'required|max:10',
            'count' => 'required|numeric|max:100000',
            'pwdlength' => 'required|numeric|max:10',
            'money' => 'required|numeric',
        );
        $messages = array(
            'length.required' => '卡号长度不允许为空！',
            'length.numeric' => '卡号长度必须是数值。',
            'length.max' => '卡号长度必须小于 :max',
            'prefix.required' => '卡号前缀不允许为空！',
            'prefix.numeric' => '卡号前缀必须是数值。',
            'prefix.max' => '卡号前缀必须小于 :max 个字符。',
            'count.required' => '生成数量不允许为空！',
            'count.numeric' => '生成数量必须是数值。',
            'count.max' => '生成数量必须小于 :max',
            'pwdlength.required' => '密码长度不允许为空！',
            'pwdlength.numeric' => '密码长度必须是数值。',
            'pwdlength.max' => '密码长度必须小于 :max 个字符。',
            'money.required' => '卡内余额不允许为空！',
            'money.numeric' => '卡内余额必须是数值。',
        );
        $this->validate($request, $rules, $messages);

        $length = $request->length > 0 ? $request->length : 16;
        $length = $length - strlen($request->prefix);
        $count = intval($request->count);
        $count = $count < 1 ? 1 : $count;
        $count = $count > 100000 ? 100000 : $count;
        $pwdlength = intval($request->pwdlength);
        $pwdlength = $pwdlength < 1 ? 1 : $pwdlength;
        $pwdlength = $pwdlength > 20 ? 20 : $pwdlength;

        $makenum = $count;
        $succeed_num = intval($request->succeed_num) > 0 ? intval($request->succeed_num) : 0;
        //分批生成
        if ($request->ajax()){
            $onepage_make = 100;
            if($count - $succeed_num > $onepage_make) {
                $makenum = $onepage_make;
            }else{
                $makenum = $count - $succeed_num;
            }
        }

        for ($i=1; $i<=$makenum; $i++) {
            $number = $request->prefix;
            for ($j=1; $j<=$length; $j++) {
                $number .= array_rand(range(0,9));
            }
            $card = CommonCardModel::where('number', $number)->first();
            if (!$card){
                /*
                $seek=mt_rand(0,9999).mt_rand(0,9999).mt_rand(0,9999); //12位
                $start=mt_rand(0,20);
                $password=strtoupper(substr(md5($seek),$start,$pwdlength));
                $password=str_replace("0",chr(mt_rand(65,78)),$password);
                */
                $password = '';
                for ($k=1; $k<=6; $k++) {
                    $password .= array_rand(range(0,9));
                }
                $card = new CommonCardModel;
                $card->number = $number;
                $card->password = $password;
                $card->money = $request->money > 0 ? $request->money : 0;
                $card->save();
                $succeed_num += 1;
            }
        }

        if ($request->ajax()){
            if ($succeed_num < $count){
                return response()->json(['status' => 1, 'step' => 1, 'info' => sprintf(trans('admin.extend.card.make_step'), $succeed_num, $count), 'url' => route('admin.extend.card.store', ['succeed_num' => $succeed_num])]);
            }else{
                return response()->json(['status' => 1, 'info' => sprintf(trans('admin.extend.card.make_succeed'), $succeed_num), 'url' => route('admin.extend.card.index')]);
            }
        }else{
            return view('admin.layouts.message', ['status' => 1, 'info' => trans('admin.extend.card.addsucceed'), 'url' => route('admin.extend.card.index')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = CommonCardModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = CommonCardModel::findOrFail($id);
        return view('admin.extend.card.edit')->with('card', $card);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $card = CommonCardModel::findOrFail($id);
        $rules = array(
            'title' => 'required|max:50',
            'url' => 'required|max:255',
        );
        $messages = array(
            'title.required' => '站点名称不允许为空！',
            'title.max' => '站点名称必须小于 :max 个字符。',
            'url.required' => '站点URL不允许为空！',
            'url.max' => '站点URL必须小于 :max 个字符。',
        );
        $this->validate($request, $rules, $messages);

        $card->title = trim($request->title);
        $card->url = $request->url;
        $card->logo = $request->logo;
        $card->description = $request->description;
        $card->displayorder = $request->displayorder;
        $card->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.card.editsucceed'), 'url' => route('admin.extend.card.index')]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.card.editsucceed'), 'url' => route('admin.extend.card.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $card = CommonCardModel::findOrFail($id);
        $card->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.extend.card.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.card.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function batch(Request $request)
    {
        if($request->operate == 'delsubmit') {
            $rules = array(
                'ids' => 'required',
            );
            $messages = array(
                'ids.required' => '请选择要删除的记录！',
            );
            $this->validate($request, $rules, $messages);
            CommonCardModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.extend.card.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('admin.layouts.message', ['status' => '1', 'info' => trans('admin.extend.card.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('admin.layouts.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

}
