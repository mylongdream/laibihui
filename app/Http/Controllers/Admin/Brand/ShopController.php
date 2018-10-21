<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\CommonSubwebModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ShopController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $BrandShopModel = new BrandShopModel;
        $shops = $BrandShopModel->where(function($query) use($request) {
            $catid = intval($request->catid);
            if($catid){
                $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
                $incatid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
                $query->whereIn('catid', $incatid);
            }
        })->where(function($query) use($request) {
            if($request->name){
                $query->where('name', 'like',"%".$request->name."%");
            }
        })->latest()->paginate(20);
        return view('admin.brand.shop.index', ['shops' => $shops, 'categorylist' => category_tree($categorylist)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.shop.create', ['subwebs' => $subwebs, 'categorylist' => category_tree($categorylist)]);
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
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'catid' => 'required|numeric|exists:brand_category,id',
            'name' => 'required|max:50|unique:brand_shop,name',
            'upphoto' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'catid.required' => '商家分类不允许为空！',
            'catid.numeric' => '商家分类选择错误！',
            'catid.exists' => '商家分类不存在！',
            'name.required' => '店铺名称不允许为空！',
            'name.max' => '店铺名称必须小于 :max 个字符。',
            'name.unique' => '店铺名称已经存在。',
            'upphoto.required' => '展示图片不允许为空！',
        );
        $request->validate($rules, $messages);

        $shop = new BrandShopModel;
        $shop->subweb_id = $request->subweb_id;
        $shop->catid = $request->catid;
        $shop->name = $request->name;
        $shop->upimage = array_first($request->upphoto);
        $shop->upphoto = serialize($request->upphoto);
        $shop->banner = $request->banner;
        $shop->address = $request->address;
        $shop->maplng = $request->maplng;
        $shop->maplat = $request->maplat;
        $shop->phone = $request->phone;
        $shop->mobile = $request->mobile;
        $shop->openhours = $request->openhours;
        $shop->discount = $request->discount;
        $shop->indiscount = $request->indiscount;
        $shop->offline = intval($request->offline) ? 1 : 0;
        $shop->ordermeal = intval($request->ordermeal) ? 1 : 0;
        $shop->appoint = intval($request->appoint) ? 1 : 0;
        $shop->ordercard = intval($request->ordercard) ? 1 : 0;
        $shop->started_at = $request->started_at ? strtotime($request->started_at) : $request->started_at;
        $shop->ended_at = $request->ended_at ? strtotime($request->ended_at) : $request->ended_at;
        $shop->viewnum = $request->viewnum;
        $shop->message = $request->message;
        $shop->seo_title = $request->seo_title;
        $shop->seo_keywords = $request->seo_keywords;
        $shop->seo_description = $request->seo_description;
        $shop->superior = $request->superior;
        $shop->moderator = $request->moderator;
        $shop->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.addsucceed'), 'url' => route('admin.brand.shop.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.shop.addsucceed'), 'url' => route('admin.brand.shop.index')]);
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
        $shop = BrandShopModel::findOrFail($id);
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        return view('admin.brand.shop.show', ['shop' => $shop, 'categorylist' => category_tree($categorylist)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $shop = BrandShopModel::findOrFail($id);
        return view('admin.brand.shop.edit', ['shop' => $shop, 'subwebs' => $subwebs, 'categorylist' => category_tree($categorylist)]);
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
        $shop = BrandShopModel::findOrFail($id);
        $rules = array(
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'catid' => 'required|numeric|exists:brand_category,id',
            'name' => 'required|max:50|unique:brand_shop,name,'.$shop->id.',id',
            'upphoto' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'catid.required' => '商家分类不允许为空！',
            'catid.numeric' => '商家分类选择错误！',
            'catid.exists' => '商家分类不存在！',
            'name.required' => '店铺名称不允许为空！',
            'name.max' => '店铺名称必须小于 :max 个字符。',
            'name.unique' => '店铺名称已经存在。',
            'upphoto.required' => '展示图片不允许为空！',
        );
        $request->validate($rules, $messages);

        $shop->subweb_id = $request->subweb_id;
        $shop->catid = $request->catid;
        $shop->username = $request->username;
        $shop->name = $request->name;
        $shop->upimage = array_first($request->upphoto);
        $shop->upphoto = serialize($request->upphoto);
        $shop->banner = $request->banner;
        $shop->address = $request->address;
        $shop->maplng = $request->maplng;
        $shop->maplat = $request->maplat;
        $shop->phone = $request->phone;
        $shop->openhours = $request->openhours;
        $shop->mobile = $request->mobile;
        $shop->discount = $request->discount;
        $shop->indiscount = $request->indiscount;
        $shop->offline = intval($request->offline) ? 1 : 0;
        $shop->ordermeal = intval($request->ordermeal) ? 1 : 0;
        $shop->appoint = intval($request->appoint) ? 1 : 0;
        $shop->ordercard = intval($request->ordercard) ? 1 : 0;
        $shop->started_at = $request->started_at ? strtotime($request->started_at) : $request->started_at;
        $shop->ended_at = $request->ended_at ? strtotime($request->ended_at) : $request->ended_at;
        $shop->viewnum = $request->viewnum;
        $shop->message = $request->message;
        $shop->seo_title = $request->seo_title;
        $shop->seo_keywords = $request->seo_keywords;
        $shop->seo_description = $request->seo_description;
        $shop->superior = $request->superior;
        $shop->moderator = $request->moderator;
        $shop->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.editsucceed'), 'url' => route('admin.brand.shop.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.shop.editsucceed'), 'url' => route('admin.brand.shop.index')]);
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
        $shop = BrandShopModel::findOrFail($id);
        $shop->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
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
            BrandShopModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.shop.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('layouts.admin.message', ['status' => '0', 'info' => trans('admin.undefined.operation')]);
        }
    }

    public function recycle(Request $request)
    {
        $shops = BrandShopModel::onlyTrashed()->where('name', 'like', '%'.$request->name.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.brand.shop.recycle', ['shops' => $shops]);
    }

    public function restore(Request $request, $id)
    {
        $shop = BrandShopModel::withTrashed()->findOrFail($id);
        $shop->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.brand.shop.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.brand.shop.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function qrcode(Request $request, $id)
    {
        $shop = BrandShopModel::findOrFail($id);
        return view('admin.brand.shop.qrcode', ['shop' => $shop]);
    }

    public function getqrcode(Request $request, $id)
    {
        $shop = BrandShopModel::findOrFail($id);
        //QrCode::format('png')->size(600)->merge(Storage::url('app/public/image/'.$shop->upimage),.2)->generate(route('mobile.brand.shop.show', $shop->id), storage_path('app/public/qrcodes/qrcode.png'));
        $qrcode_name = 'qrcode_'.$shop->id.'_'.$request->pixsize.'.png';
        $qrcode = storage_path('app/public/qrcode/shop/'.$qrcode_name);
        QrCode::format('png')->size($request->pixsize)->generate(route('mobile.brand.shop.show', $shop->id), $qrcode);
        return response()->download($qrcode);
    }

    public function nearby(Request $request)
    {
        $rules = array(
            'catid' => 'required|numeric|min:1',
            'maplat' => 'required|numeric|min:0|max:180',
            'maplng' => 'required|numeric|min:-90|max:90',
        );
        $messages = array(
            'catid.required' => '商家分类不能为空！',
            'catid.numeric' => '商家分类格式错误！',
            'catid.min' => '商家分类格式错误！',
            'maplat.required' => '地图坐标经度不能为空！',
            'maplat.numeric' => '地图坐标经度格式错误！',
            'maplat.min' => '地图坐标经度格式错误！',
            'maplat.max' => '地图坐标经度格式错误！',
            'maplng.required' => '地图坐标纬度不能为空！',
            'maplng.numeric' => '地图坐标纬度格式错误！',
            'maplng.min' => '地图坐标纬度格式错误！',
            'maplng.max' => '地图坐标纬度格式错误！',
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
        return view('admin.brand.shop.nearby', ['shops' => $shops]);
    }

}
