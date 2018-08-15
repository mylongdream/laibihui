<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\BrandCategoryModel;
use App\Models\BrandCollectionModel;
use App\Models\BrandCommentModel;
use App\Models\BrandHistoryModel;
use App\Models\BrandProductModel;
use App\Models\BrandAppointModel;
use App\Models\BrandShopModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Toplan\PhpSms\Facades\Sms;


class ShopController extends Controller
{
    public function __construct()
    {
        view()->share(['curmenu' => 'shop']);
    }

    public function index(Request $request){
        $categorylist = BrandCategoryModel::orderBy('displayorder', 'asc')->get();
        $shopcates = $categorylist->where('parentid', 0)->take(12);
        $catid = intval($request->catid);
        if($catid){
            $category = BrandCategoryModel::where('id', $catid)->first();
            if($category){
                $catid = collect(category_tree($categorylist, $catid))->pluck('id')->prepend($catid);
                $shopcates = $categorylist->where('parentid', $category->parentid)->take(12);
            }else{
                $catid = 0;
            }
        }
        $BrandShopModel = new BrandShopModel;
        $shoplist = $BrandShopModel->where(function($query) use($catid) {
            if($catid){
                $query->whereIn('catid', $catid);
            }
        })->where(function($query) use($request) {
            $discount = intval($request->discount);
            switch ($discount){
                case 1:
                    $query->where('discount', '>=', 9);
                    break;
                case 2:
                    $query->where('discount', '<=', 9)->where('discount', '>=', 8);
                    break;
                case 3:
                    $query->where('discount', '<=', 8)->where('discount', '>=', 7);
                    break;
                case 4:
                    $query->where('discount', '<=', 7)->where('discount', '>=', 6);
                    break;
                case 5:
                    $query->where('discount', '<=', 6)->where('discount', '>=', 5);
                    break;
                case 6:
                    $query->where('discount', '<=', 5);
                    break;
                default:
                    break;
            }
        })->where(function($query) use($request) {
            if($request->keyword){
                $query->where('name', 'like',"%".$request->keyword."%");
            }
        });
        switch ($request->orderby){
            case 'discount':
                $shoplist = $shoplist->orderBy('discount', 'asc');
                break;
            case 'viewnum':
                $shoplist = $shoplist->orderBy('viewnum', 'desc');
                break;
            case 'addtime':
                $shoplist = $shoplist->orderBy('created_at', 'desc');
                break;
            default:
                break;
        }
        $shoplist = $shoplist->paginate(20);
        return view('brand.shop.index', ['shoplist' => $shoplist, 'shopcates' => $shopcates]);
    }

    public function show(Request $request){
        $newshops = BrandShopModel::latest()->get()->take(6);
        $hotshops = BrandShopModel::orderBy('viewnum', 'desc')->get()->take(6);
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        //if($article->city){
            //return redirect()->route('subweb.article.detail',[$article->city['domain'],$article->article_id]);
        //}else{
        $shop->increment('viewnum');
        if (auth()->check()) {
            $history = BrandHistoryModel::firstOrNew(['uid' => auth()->user()->uid, 'shop_id' => $shop->id]);
            $history->uid = auth()->user()->uid;
            $history->shop_id = $shop->id;
            $history->postip = request()->getClientIp();
            $history->updated_at = time();
            $history->save();
        }
        //$shop->qrcode = QrCode::format('png')->size(600)->merge(Storage::url('app/public/image/'.$shop->upimage),.2)->generate(route('mobile.brand.shop.show', $shop->id), storage_path('app/public/qrcodes/qrcode.png'));
            return view('brand.shop.show', ['shop'=>$shop,'newshops'=>$newshops,'hotshops'=>$hotshops]);
        //}
    }

    public function comment(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            if (!auth()->check()) {
                return response()->json(['status' => '0', 'info' => '请登录后再评论']);
            }

            $rules = array(
                'service' => 'required|numeric|min:1|max:5',
                'environment' => 'required|numeric|min:1|max:5',
                'priceratio' => 'required|numeric|min:1|max:5',
                'message' => 'required|max:50',
            );
            $messages = array(
                'service.required' => '服务尚未评分！',
                'service.numeric' => '服务评分错误。',
                'service.min' => '服务评分错误。',
                'service.max' => '服务评分错误。',
                'environment.required' => '环境尚未评分！',
                'environment.numeric' => '环境评分错误。',
                'environment.min' => '环境评分错误。',
                'environment.max' => '环境评分错误。',
                'priceratio.required' => '性价比尚未评分！',
                'priceratio.numeric' => '性价比评分错误。',
                'priceratio.min' => '性价比评分错误。',
                'priceratio.max' => '性价比评分错误。',
                'message.required' => '评论内容不允许为空！',
                'message.max' => '评论内容必须小于 :max 个字符。',
            );
            $this->validate($request, $rules, $messages);

            $comment = new BrandCommentModel;
            $comment->uid = auth()->user()->uid;
            $comment->shop_id = $shop->id;
            $comment->message = $request->message;
            $comment->service = intval($request->service);
            $comment->environment = intval($request->environment);
            $comment->priceratio = intval($request->priceratio);
            if($request->upphoto) {
                $comment->upphoto = serialize($request->upphoto);
            }
            $comment->postip = request()->getClientIp();
            $comment->save();

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.common.message', ['status' => '1', 'info' => '评论发表成功', 'url' => back()->getTargetUrl()]);
            }
        }else {
            $newshops = BrandShopModel::latest()->get()->take(6);
            $hotshops = BrandShopModel::orderBy('viewnum', 'desc')->get()->take(6);
            $commentlist = BrandCommentModel::where('shop_id', $shop->id)->latest()->paginate(12);
            return view('brand.shop.comment', ['commentlist' => $commentlist, 'shop' => $shop, 'newshops' => $newshops, 'hotshops' => $hotshops]);
        }
    }

    public function appoint(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if($request->isMethod('POST')){
            if (!auth()->check()) {
                return response()->json(['status' => '0', 'info' => '请登录后再预约']);
            }

            $rules = array(
                'realname' => 'required|max:10',
                'number' => 'required|numeric|min:1',
                'mobile' => 'required|zh_mobile|max:15',
                'appoint_at' => 'required|date|after:today',
            );
            $messages = array(
                'realname.required' => '顾客姓名不允许为空！',
                'realname.max' => '顾客姓名必须小于 :max 个字符。',
                'number.required' => '预约人数不允许为空！',
                'number.numeric' => '预约人数必须为数值。',
                'number.min' => '预约人数不能少于 :min 人。',
                'mobile.required' => '手机号码不允许为空！',
                'mobile.zh_mobile' => '手机号码填写错误！',
                'mobile.max' => '手机号码必须小于 :max 个字符。',
                'appoint_at.required' => '预约时间不允许为空！',
                'appoint_at.max' => '预约时间格式不对。',
                'appoint_at.after' => '预约时间填写错误。',
            );
            $this->validate($request, $rules, $messages);

            $appoint = new BrandAppointModel;
            $appoint->uid = auth()->user()->uid;
            $appoint->shop_id = $shop->id;
            $appoint->realname = $request->realname;
            $appoint->number = intval($request->number);
            $appoint->mobile = $request->mobile;
            $appoint->appoint_at = $request->appoint_at ? strtotime($request->appoint_at) : $request->appoint_at;
            $appoint->remark = $request->remark;
            $appoint->order_sn = date("YmdHis") . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $appoint->postip = request()->getClientIp();
            $appoint->save();

            if ($shop->mobile){
                $content = '店铺有客户预约，姓名：'.$appoint->realname.'，手机：'.$appoint->mobile.'，预约人数：'.$appoint->number.'人，预约时间：'.$appoint->appoint_at->format('Y-m-d H:i').($appoint->remark ? '，备注：'.$appoint->remark : '');
                Sms::make()->to([86, $shop->mobile])->content($content)->send();
            }

            if ($request->ajax()){
                return response()->json(['status' => '1', 'info' => '预约成功', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.common.message', ['status' => '1', 'info' => '预约成功', 'url' => back()->getTargetUrl()]);
            }
        }else{
            return view('brand.shop.appoint', ['shop'=>$shop]);
        }
    }

    public function collection(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        if (!auth()->check()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.common.message', ['status' => 0, 'info' => '请登录后再收藏', 'url' => back()->getTargetUrl()]);
            }
        }
        if (auth()->user()->collections()->where('shop_id', $shop->id)->count()) {
            if ($request->ajax()){
                return response()->json(['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.common.message', ['status' => 0, 'info' => '已经收藏过此店铺', 'url' => back()->getTargetUrl()]);
            }
        }

        $collection = new BrandCollectionModel;
        $collection->uid = auth()->user()->uid;
        $collection->shop_id = $shop->id;
        $collection->postip = request()->getClientIp();
        $collection->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.common.message', ['status' => '1', 'info' => '收藏成功', 'url' => back()->getTargetUrl()]);
        }
    }

    public function qrcode(Request $request)
    {
        $pixsize = 550;
        $shop = BrandShopModel::findOrFail($request->id);
        $qrcode_name = 'qrcode_'.$shop->id.'_'.$pixsize.'.png';
        $qrcode = storage_path('app/public/qrcode/shop/'.$qrcode_name);
        if(!Storage::disk('public')->exists('qrcode/shop/'.$qrcode_name)) {
            QrCode::format('png')->size($pixsize)->generate(route('mobile.brand.shop.show', $shop->id), $qrcode);
        }
        $img = Image::make(Storage::disk('public')->get('qrcode/shop/'.$qrcode_name));
        return $img->response('png', 90);
    }

    public function product(Request $request){
        $shop = BrandShopModel::where('id', $request->id)->firstOrFail();
        $products = BrandProductModel::where('shop_id', $shop->id)->latest()->paginate(15);
        return view('brand.shop.product', ['shop'=>$shop, 'products' => $products]);
    }

}
