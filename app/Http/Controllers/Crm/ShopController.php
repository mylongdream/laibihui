<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\BrandShopArchiveModel;
use App\Models\BrandShopCardAllotModel;
use App\Models\BrandShopCardModel;
use App\Models\BrandShopModel;
use App\Models\CommonCardModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function __construct()
    {
        view()->share('curmenu', 'shop');
    }

    public function index(Request $request)
    {
        $BrandShopModel = new BrandShopModel;
        $shops = $BrandShopModel->whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->where(function($query) use($request) {
            if($request->address){
                $query->where('address', 'like',"%".$request->address."%");
            }
        })->withCount(['shopcards', 'shopcards AS sellcards_count' => function ($query) {
            $query->has('card');
        }])->latest()->paginate(20);
        return view('crm.shop.index', ['shops' => $shops]);
    }

    public function edit(Request $request, $id)
    {
        $shop = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->findOrFail($id);
        $archive = BrandShopArchiveModel::where('uid', auth('crm')->user()->uid)->where('shop_id', $shop->id)->where('status', 0)->first();
        if ($archive){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '很抱歉，该商户有编辑资料正在审核，您暂时无法编辑', 'url' => route('crm.shop.index')]);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '很抱歉，该商户有编辑资料正在审核，您暂时无法编辑', 'url' => route('crm.shop.index')]);
            }
        }
        return view('crm.shop.edit')->with('shop', $shop);
    }

    public function update(Request $request, $id)
    {
        $shop = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->findOrFail($id);
        $archive = BrandShopArchiveModel::where('uid', auth('crm')->user()->uid)->where('shop_id', $shop->id)->where('status', 0)->first();
        if ($archive){
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '很抱歉，该商户有编辑资料正在审核，您暂时无法编辑', 'url' => route('crm.shop.index')]);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '很抱歉，该商户有编辑资料正在审核，您暂时无法编辑', 'url' => route('crm.shop.index')]);
            }
        }
        $rules = array(
            'upphoto' => 'required',
        );
        $messages = array(
            'upphoto.required' => '展示图片不允许为空！',
        );
        $this->validate($request, $rules, $messages);

        $archive = new BrandShopArchiveModel();
        $archive->uid = auth('crm')->user()->uid;
        $archive->shop_id = $shop->id;
        $archive->upimage = array_first($request->upphoto);
        $archive->upphoto = serialize($request->upphoto);
        $archive->message = $request->message;
        $archive->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '客户资料成功提交审核', 'url' => route('crm.shop.index')]);
        }else{
            return view('layouts.crm.message', ['status' => 1, 'info' => '客户资料成功提交审核', 'url' => route('crm.shop.index')]);
        }

/*
        $shop->upimage = array_first($request->upphoto);
        $shop->upphoto = serialize($request->upphoto);
        $shop->message = $request->message;
        $shop->save();

        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => '编辑客户资料成功', 'url' => route('crm.shop.index')]);
        }else{
            return view('layouts.crm.message', ['status' => 1, 'info' => '编辑客户资料成功', 'url' => route('crm.shop.index')]);
        }
 */
    }

    public function allot(Request $request, $id)
    {
        $shop = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->findOrFail($id);
        $allots = BrandShopCardAllotModel::where('shop_id', $shop->id)->latest()->paginate(20);
        return view('crm.shop.allot', ['shop' => $shop, 'allots' => $allots]);
    }

    public function card(Request $request, $id)
    {
        $shop = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->findOrFail($id);
        $BrandShopCardModel = new BrandShopCardModel;
        $cards = $BrandShopCardModel->where('shop_id', $shop->id)->where(function($query) use($request) {
            if($request->number){
                $query->where('number', 'like',"%".$request->number."%");
            }
        })->latest()->paginate(20);
        return view('crm.shop.card', ['shop' => $shop, 'cards' => $cards]);
    }

    public function addcard(Request $request, $id)
    {
        $shop = BrandShopModel::whereHas('moderator', function ($query) {
            $query->where('uid', auth('crm')->user()->uid);
        })->findOrFail($id);
        $allot = BrandShopCardAllotModel::where('shop_id', $shop->id)->findOrFail($request->allotid);
        if($allot->quantity <= $allot->cardlist->count()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '卡号已分配完成']);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '卡号已分配完成']);
            }
        }
        if ($request->isMethod('POST')) {
            $rules = array(
                'number' => 'required',
            );
            $messages = array(
                'number.required' => '卡号不允许为空！',
            );
            $request->validate($rules, $messages);

            $succeed_num = $failed_num = 0;
            $numberData = explode("\r\n", $request->number);
            if(count($numberData) > $allot->quantity - $allot->cardlist->count()) {
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '卡号超出剩余分配数量']);
                }else{
                    return view('layouts.crm.message', ['status' => 0, 'info' => '卡号超出剩余分配数量']);
                }
            }
            foreach ($numberData as $value){
                if($value){
                    $card = CommonCardModel::where('number', $value)->first();
                    if($card && !$card->user) {
                        $shopcard = BrandShopCardModel::where('number', $value)->first();
                        if(!$shopcard) {
                            $shopcard = new BrandShopCardModel;
                            $shopcard->shop_id = $shop->id;
                            $shopcard->allot_id = $allot->id;
                            $shopcard->number = $value;
                            $shopcard->postip = request()->getClientIp();
                            $shopcard->save();
                            $succeed_num += 1;
                        }else{
                            $failed_num += 1;
                        }
                    }else{
                        $failed_num += 1;
                    }
                }
            }

            if ($request->ajax()){
                return response()->json(['status' => 1, 'info' => '分配卡号成功'.$succeed_num.'张，失败'.$failed_num.'张', 'url' => route('crm.shop.card', ['id' => $shop->id, 'allotid' => $allot->id])]);
            }else{
                return view('layouts.crm.message', ['status' => 1, 'info' => '分配卡号成功'.$succeed_num.'张，失败'.$failed_num.'张', 'url' => route('crm.shop.card', ['id' => $shop->id, 'allotid' => $allot->id])]);
            }
        }else{
            return view('crm.shop.addcard', ['shop' => $shop, 'allot' => $allot]);
        }
    }

    public function checkcard(Request $request)
    {
        $rules = array(
            'number' => 'required',
        );
        $messages = array(
            'number.required' => '卡号不允许为空！',
        );
        $request->validate($rules, $messages);

        $card = CommonCardModel::where('number', $request->number)->first();
        if($card && !$card->user) {
            $shopcard = BrandShopCardModel::where('number', $request->number)->first();
            if($shopcard) {
                if ($request->ajax()){
                    return response()->json(['status' => 0, 'info' => '卡号已存在']);
                }else{
                    return view('layouts.crm.message', ['status' => 0, 'info' => '卡号已存在']);
                }
            }
        }else{
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '卡号不存在']);
            }else{
                return view('layouts.crm.message', ['status' => 0, 'info' => '卡号不存在']);
            }
        }
    }

    public function nearby(Request $request)
    {
        $rules = array(
            'catid' => 'required|numeric|min:1',
            'maplng' => 'required|numeric|min:0|max:180',
            'maplat' => 'required|numeric|min:-90|max:90',
        );
        $messages = array(
            'catid.required' => '商家分类不能为空！',
            'catid.numeric' => '商家分类格式错误！',
            'catid.min' => '商家分类格式错误！',
            'maplng.required' => '地图坐标经度不能为空！',
            'maplng.numeric' => '地图坐标经度格式错误！',
            'maplng.min' => '地图坐标经度格式错误！',
            'maplng.max' => '地图坐标经度格式错误！',
            'maplat.required' => '地图坐标纬度不能为空！',
            'maplat.numeric' => '地图坐标纬度格式错误！',
            'maplat.min' => '地图坐标纬度格式错误！',
            'maplat.max' => '地图坐标纬度格式错误！',
        );
        $this->validate($request, $rules, $messages);
        $maplat = $request->maplat;
        $maplng = $request->maplng;
        $shops = BrandShopModel::select('*')->selectRaw('ROUND(2 * 6378.137* ASIN(SQRT(POW(SIN(PI()*('.$maplat.'-maplat)/360),2)+COS(PI()*'.$maplat.'/180)* COS(maplat * PI()/180)*POW(SIN(PI()*('.$maplng.'-maplng)/360),2)))*1000) AS distance')->where('maplat', '>', 0)->where('maplng', '>', 0)->where(function($query) use($request) {
            if($request->catid){
                $query->where('catid', $request->catid);
            }
        })->where(function($query) use($request) {
            if($request->id){
                $query->where('id', '<>', $request->id);
            }
        })->orderBy('distance', 'asc')->latest()->get()->take(5);
        return view('crm.shop.nearby', ['shops' => $shops]);
    }

}
