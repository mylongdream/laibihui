<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;
use App\Models\CommonUploadImageModel;
use App\Models\CommonUserProfileModel;
use App\Models\CommonUserScoreModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        view()->share('curmenu', 'profile');
    }

    public function index()
    {
        $profile = auth()->user()->profile;
        if($profile){
            return view('mobile.user.profile.edit', ['profile' => $profile]);
        }else{
            return view('mobile.user.profile.create');
        }
    }

    public function face(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileExt = $file->getClientOriginalExtension();
            $fileName = date('His').strtolower(Str::random(16)).'.'.$fileExt;
            $filePath = $file->storeAs('image/'.date('Ym').'/'.date('d'), $fileName, 'public');
            $filePath = str_replace('image/', '', $filePath);
            $uploadimage = new CommonUploadImageModel();
            $uploadimage->filename = $file->getClientOriginalName();
            $uploadimage->description = $file->getClientOriginalName();
            $uploadimage->filepath = $filePath;
            $uploadimage->filesize = $file->getSize();
            $uploadimage->save();
            auth()->user()->headimgurl = $uploadimage->filepath;
            auth()->user()->save();
            return response()->json(['status' => 1, 'url' => uploadImage($uploadimage->filepath), 'value' => $uploadimage->filepath]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function store(Request $request)
    {
        $rules = array(
            'realname' => 'required|max:10',
            'email' => 'required|email|max:40',
            'gender' => 'required|numeric',
            'marry' => 'required|max:16',
            'workprovince' => 'required|numeric|exists:common_district,id',
            'workcity' => 'required|numeric|exists:common_district,id',
            'workarea' => 'required|numeric|exists:common_district,id',
            'workstreet' => 'nullable|numeric|exists:common_district,id',
            'birthday' => 'required|date|before:today',
            'hobby' => 'required|max:80',
            'stage' => 'required|max:10',
            'occupation' => 'required|max:16',
        );
        $messages = array(
            'realname.required' => '真实姓名不允许为空！',
            'realname.max' => '真实姓名填写错误！',
            'email.required' => '邮箱不允许为空！',
            'email.email' => '邮箱填写错误！',
            'email.max' => '邮箱填写错误！',
            'gender.required' => '性别不允许为空！',
            'gender.numeric' => '性别选择错误！',
            'birthday.required' => '生日不允许为空！',
            'birthday.date' => '生日格式错误！',
            'birthday.before' => '生日填写错误！',
            'workprovince.required' => '工作所在省份不允许为空！',
            'workprovince.numeric' => '工作所在省份选择错误！',
            'workprovince.exists' => '工作所在省份不存在！',
            'workcity.required' => '工作所在城市不允许为空！',
            'workcity.numeric' => '工作所在城市选择错误！',
            'workcity.exists' => '工作所在城市不存在！',
            'workarea.required' => '工作所在地区不允许为空！',
            'workarea.numeric' => '工作所在地区选择错误！',
            'workarea.exists' => '工作所在地区不存在！',
            'workstreet.numeric' => '工作所在街道选择错误！',
            'workstreet.exists' => '工作所在街道不存在！',
            'marry.required' => '婚姻状况不允许为空！',
            'marry.max' => '婚姻状况不能超过 :max 个字符！',
            'hobby.required' => '兴趣爱好不允许为空！',
            'hobby.max' => '兴趣爱好不能超过 :max 个字符！',
            'stage.required' => '正处阶段不允许为空！',
            'stage.max' => '正处阶段不能超过 :max 个字符！',
            'occupation.required' => '职业不允许为空！',
            'occupation.max' => '职业不能超过 :max 个字符！',
        );
        $request->validate($rules, $messages);

        if (!auth()->user()->profile){ //首次送20积分
            $givescore = 20;
            $score = new CommonUserScoreModel();
            $score->uid = auth()->user()->uid;
            $score->score = $givescore;
            $score->remark = '补充个人资料送积分';
            $score->postip = $request->getClientIp();
            $score->save();
            auth()->user()->increment('score', $givescore);
        }

        $profile = CommonUserProfileModel::firstOrNew(['uid' => auth()->user()->uid]);
        $profile->realname = $request->realname;
        $profile->email = $request->email;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday ? strtotime($request->birthday) : $request->birthday;
        $profile->workprovince = intval($request->workprovince);
        $profile->workcity = intval($request->workcity);
        $profile->workarea = intval($request->workarea);
        $profile->workstreet = intval($request->workstreet);
        $profile->marry = $request->marry;
        $profile->hobby = $request->hobby;
        $profile->stage = $request->stage;
        $profile->occupation = $request->occupation;
        $profile->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.profile.addsucceed'), 'url' => route('mobile.user.profile.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.profile.addsucceed'), 'url' => route('mobile.user.profile.index')]);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'realname' => 'required|max:10',
            'email' => 'required|email|max:40',
            'gender' => 'required|numeric',
            'marry' => 'required|max:16',
            'workprovince' => 'required|numeric|exists:common_district,id',
            'workcity' => 'required|numeric|exists:common_district,id',
            'workarea' => 'required|numeric|exists:common_district,id',
            'workstreet' => 'nullable|numeric|exists:common_district,id',
            'birthday' => 'required|date|before:today',
            'hobby' => 'required|max:80',
            'stage' => 'required|max:10',
            'occupation' => 'required|max:16',
        );
        $messages = array(
            'realname.required' => '真实姓名不允许为空！',
            'realname.max' => '真实姓名填写错误！',
            'email.required' => '邮箱不允许为空！',
            'email.email' => '邮箱填写错误！',
            'email.max' => '邮箱填写错误！',
            'gender.required' => '性别不允许为空！',
            'gender.numeric' => '性别选择错误！',
            'birthday.required' => '生日不允许为空！',
            'birthday.date' => '生日格式错误！',
            'birthday.before' => '生日填写错误！',
            'workprovince.required' => '工作所在省份不允许为空！',
            'workprovince.numeric' => '工作所在省份选择错误！',
            'workprovince.exists' => '工作所在省份不存在！',
            'workcity.required' => '工作所在城市不允许为空！',
            'workcity.numeric' => '工作所在城市选择错误！',
            'workcity.exists' => '工作所在城市不存在！',
            'workarea.required' => '工作所在地区不允许为空！',
            'workarea.numeric' => '工作所在地区选择错误！',
            'workarea.exists' => '工作所在地区不存在！',
            'workstreet.numeric' => '工作所在街道选择错误！',
            'workstreet.exists' => '工作所在街道不存在！',
            'marry.required' => '婚姻状况不允许为空！',
            'marry.max' => '婚姻状况不能超过 :max 个字符！',
            'hobby.required' => '兴趣爱好不允许为空！',
            'hobby.max' => '兴趣爱好不能超过 :max 个字符！',
            'stage.required' => '正处阶段不允许为空！',
            'stage.max' => '正处阶段不能超过 :max 个字符！',
            'occupation.required' => '职业不允许为空！',
            'occupation.max' => '职业不能超过 :max 个字符！',
        );
        $request->validate($rules, $messages);

        $profile = CommonUserProfileModel::firstOrNew(['uid' => auth()->user()->uid]);
        $profile->realname = $request->realname;
        $profile->email = $request->email;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday ? strtotime($request->birthday) : $request->birthday;
        $profile->workprovince = intval($request->workprovince);
        $profile->workcity = intval($request->workcity);
        $profile->workarea = intval($request->workarea);
        $profile->workstreet = intval($request->workstreet);
        $profile->marry = $request->marry;
        $profile->hobby = $request->hobby;
        $profile->stage = $request->stage;
        $profile->occupation = $request->occupation;
        $profile->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('user.profile.updatesucceed'), 'url' => route('mobile.user.profile.index')]);
        }else{
            return view('layouts.mobile.message', ['status' => '1', 'info' => trans('user.profile.updatesucceed'), 'url' => route('mobile.user.profile.index')]);
        }
    }

    public function mobile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = array(
                'mobile' => 'bail|required|zh_mobile|unique:common_user|confirm_mobile_not_change',
                'smscode' => 'required|verify_code',
            );
            $messages = array(
                'mobile.required' => '手机号不允许为空！',
                'smscode.max' => '验证码不允许为空！',
            );
            $request->validate($rules, $messages);
            if(auth()->user()->mobile){
                auth()->user()->mobile = $request->mobile;
                auth()->user()->save();
                if ($request->ajax()){
                    return response()->json(['status' => '1', 'info' => '手机号修改成功', 'url' => route('mobile.user.index')]);
                }else{
                    return view('layouts.mobile.message', ['status' => '1', 'info' => '手机号修改成功', 'url' => route('mobile.user.index')]);
                }
            }else{
                auth()->user()->mobile = $request->mobile;
                auth()->user()->save();
                if ($request->ajax()){
                    return response()->json(['status' => '1', 'info' => '手机号绑定成功', 'url' => route('mobile.user.index')]);
                }else{
                    return view('layouts.mobile.message', ['status' => '1', 'info' => '手机号绑定成功', 'url' => route('mobile.user.index')]);
                }
            }
        }else{
            return view('mobile.user.profile.mobile');
        }
    }

}
