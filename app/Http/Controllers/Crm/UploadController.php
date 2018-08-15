<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\CommonUploadAudioModel;
use App\Models\CommonUploadImageModel;
use App\Models\CommonUploadVideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class UploadController extends Controller
{

    public function image(Request $request)
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
            return response()->json(['status' => 1, 'url' => uploadImage($uploadimage->filepath), 'value' => $uploadimage->filepath]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function video(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileExt = $file->getClientOriginalExtension();
            $fileName = date('His').strtolower(Str::random(16)).'.'.$fileExt;
            $filePath = $file->storeAs('video/'.date('Ym').'/'.date('d'), $fileName, 'public');
            $filePath = str_replace('video/', '', $filePath);
            $uploadvideo = new CommonUploadVideoModel();
            $uploadvideo->filename = $file->getClientOriginalName();
            $uploadvideo->description = $file->getClientOriginalName();
            $uploadvideo->filepath = $filePath;
            $uploadvideo->filesize = $file->getSize();
            $uploadvideo->save();
            return response()->json(['status' => 1, 'url' => uploadVideo($uploadvideo->filepath), 'value' => $uploadvideo->filepath]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function audio(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileExt = $file->getClientOriginalExtension();
            $fileName = date('His').strtolower(Str::random(16)).'.'.$fileExt;
            $filePath = $file->storeAs('audio/'.date('Ym').'/'.date('d'), $fileName, 'public');
            $filePath = str_replace('audio/', '', $filePath);
            $uploadaudio = new CommonUploadAudioModel();
            $uploadaudio->filename = $file->getClientOriginalName();
            $uploadaudio->description = $file->getClientOriginalName();
            $uploadaudio->filepath = $filePath;
            $uploadaudio->filesize = $file->getSize();
            $uploadaudio->save();
            return response()->json(['status' => 1, 'url' => uploadAudio($uploadaudio->filepath), 'value' => $uploadaudio->filepath]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function editor(Request $request)
    {
        // 定义允许上传的文件扩展名
        $ext_arr = array (
            'image' => array ('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array ('swf', 'flv'),
            'audio' => array ('wav', 'mp3'),
            'video' => array ('mp4', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array ('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2')
        );
        if($request->hasFile('imgFile')){
            $file = $request->file('imgFile');
            $fileExt = $file->getClientOriginalExtension();
            $fileName = date('His').strtolower(Str::random(16)).'.'.$fileExt;
            $dir_name = '';
            foreach ($ext_arr as $key=>$value){
                if(in_array($fileExt, $value)){
                    $dir_name = $key;
                }
            }
            if (empty($dir_name)) {
                return response()->json(['error' => 1, 'message' =>"上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。"]);
            }
            $filePath = $file->storeAs($dir_name.'/'.date('Ym').'/'.date('d'), $fileName, 'public');
            $filePath = str_replace($dir_name.'/', '', $filePath);
            if($dir_name == 'image'){
                $uploadimage = new CommonUploadImageModel();
                $uploadimage->filename = $file->getClientOriginalName();
                $uploadimage->description = $file->getClientOriginalName();
                $uploadimage->filepath = $filePath;
                $uploadimage->filesize = $file->getSize();
                $uploadimage->save();
                return response()->json(['error' => 0, 'url' => uploadImage($uploadimage->filepath), 'value' => $uploadimage->filepath]);
            }elseif ($dir_name == 'video'){
                $uploadvideo = new CommonUploadVideoModel();
                $uploadvideo->filename = $file->getClientOriginalName();
                $uploadvideo->description = $file->getClientOriginalName();
                $uploadvideo->filepath = $filePath;
                $uploadvideo->filesize = $file->getSize();
                $uploadvideo->save();
                return response()->json(['error' => 0, 'url' => uploadVideo($uploadvideo->filepath), 'value' => $uploadvideo->filepath]);
            }elseif ($dir_name == 'audio'){
                $uploadaudio = new CommonUploadAudioModel();
                $uploadaudio->filename = $file->getClientOriginalName();
                $uploadaudio->description = $file->getClientOriginalName();
                $uploadaudio->filepath = $filePath;
                $uploadaudio->filesize = $file->getSize();
                $uploadaudio->save();
                return response()->json(['error' => 0, 'url' => uploadAudio($uploadaudio->filepath), 'value' => $uploadaudio->filepath]);
            }
            return response()->json(['error' => 1, 'message' =>'上传失败了']);
        }else{
            return response()->json(['error' => 1, 'message' =>'上传失败了']);
        }
    }
}
