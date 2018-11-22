<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\CommonUploadImageModel;
use App\Models\CommonUploadVideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Vinkla\Hashids\Facades\Hashids;
use FFMpeg;

class UploadController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function image(Request $request){
        $url = $request->month.'/'.$request->day.'/'.$request->name;
        $image = CommonUploadImageModel::where('filepath', $url)->firstOrFail();
        $image->increment('viewnum');
        $url = 'image/'.$url;
        if(Storage::disk('public')->exists($url)){
            $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
            $thumbext = addslashes(strtolower(substr(strrchr($url, '.'), 1, 10)));
            if(in_array($thumbext, $imgext)) {
                $img = Image::make(Storage::disk('public')->get($url));
                return $img->response($thumbext, 90);
            }
        }
        return '';
    }

    public function thumb(Request $request){
        $url = $request->month.'/'.$request->day.'/'.$request->name;
        $url = 'thumb/'.$url;
        if(Storage::disk('public')->exists($url)){
            $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
            $thumbext = addslashes(strtolower(substr(strrchr($url, '.'), 1, 10)));
            if(in_array($thumbext, $imgext)) {
                $img = Image::make(Storage::disk('public')->get($url));
                return $img->response($thumbext, 90);
            }
        }
        return '';
    }

    public function qrcode(Request $request){
        $url = $request->one.'/'.$request->two;
        $url = 'qrcode/'.$url;
        if(Storage::disk('public')->exists($url)){
            $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
            $thumbext = addslashes(strtolower(substr(strrchr($url, '.'), 1, 10)));
            if(in_array($thumbext, $imgext)) {
                $img = Image::make(Storage::disk('public')->get($url));
                return $img->response($thumbext, 90);
            }
        }
        return '';
    }

    public function video($id, Request $request){
        $id = Hashids::connection('video')->decode($id);
        $video = CommonUploadVideoModel::where('id', $id)->firstOrFail();
        $filepath = 'video/'.$video->filepath;
        $storage = 'storage/';
        if(Storage::disk('public')->exists($filepath)){
            $imgext  = array('mp4', 'rmvb', 'mkv', 'mov', 'avi');
            $thumbext = addslashes(strtolower(substr(strrchr($filepath, '.'), 1, 10)));
            if(in_array($thumbext, $imgext)) {
                $ffmpeg = FFMpeg\FFMpeg::create([
                    'ffmpeg.binaries'  => config('ffmpeg.ffmpeg'),
                    'ffprobe.binaries' => config('ffmpeg.ffprobe'),
                    'timeout'          => 3600, // The timeout for the underlying process
                    'ffmpeg.threads'   => 2,   // The number of threads that FFMpeg should use
                ]);
                $video = $ffmpeg->open($storage.$filepath);
                return getVideoInfo($storage.$filepath);
                return asset($storage.$filepath);
            }
        }
        return '';
    }
}
