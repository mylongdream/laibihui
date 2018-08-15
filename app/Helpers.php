<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function checkrobot($useragent = '') {
    static $kw_spiders = array('bot', 'crawl', 'spider' ,'slurp', 'sohu-search', 'lycos', 'robozilla');
    static $kw_browsers = array('msie', 'netscape', 'opera', 'konqueror', 'mozilla');

    $useragent = strtolower(empty($useragent) ? $_SERVER['HTTP_USER_AGENT'] : $useragent);
    if(strpos($useragent, 'http://') === false && dstrpos($useragent, $kw_browsers)) return false;
    if(dstrpos($useragent, $kw_spiders)) return true;
    return false;
}

function dstrpos($string, $arr, $returnvalue = false) {
    if(empty($string)) return false;
    foreach((array)$arr as $v) {
        if(strpos($string, $v) !== false) {
            $return = $returnvalue ? $v : true;
            return $return;
        }
    }
    return false;
}

function size_count($bytes, $decimals = 2) {
    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)).' '.@$size[$factor];
}

function category_tree($data, $pid = 0, $count = 1) {
    $treeList = array();
    foreach ($data as $key => $value){
        if($value['parentid'] == $pid){
            $value['count'] = $count;
            $treeList[] = $value;
            unset($data[$key]);
            $treeList = array_merge($treeList, category_tree($data, $value['id'], $count+1));
        }
    }
    return $treeList;
}

function uploadImage($filepath, $extra = array()) {
    $parse = parse_url($filepath);
    if(isset($parse['host'])) {
        return $filepath;
    }
    $route = 1;
    $imagefolder = 'image/';
    $thumbfolder = 'thumb/';
    $ext_arr  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
    $imgext = addslashes(strtolower(substr(strrchr($filepath, '.'), 1, 10)));
    if(!empty($extra) && in_array($imgext, $ext_arr)) {
        $thumbwidth = isset($extra['width']) ? $extra['width'] : '100';
        $thumbheight = isset($extra['height']) ? $extra['height'] : '100';
        $thumbtype = isset($extra['type']) ? $extra['type'] : '1';
        $thumbpath = dirname($filepath).'/'.basename($filepath, '.'.$imgext).'_'.$thumbwidth.'x'.$thumbheight.'_'.$thumbtype.'.'.$imgext;
        if(!Storage::disk('public')->exists($thumbfolder.$thumbpath) && Storage::disk('public')->exists($imagefolder.$filepath)){
            Storage::disk('public')->copy($imagefolder.$filepath, $thumbfolder.$thumbpath);
            $img = Image::make(storage_path('app/public/'.$thumbfolder.$thumbpath));
            switch($thumbtype) {
                case 1://按比例缩小
                    $img->widen($thumbwidth);
                    if($img->height() > $thumbheight){
                        $img->heighten($thumbheight);
                    }
                    $img->save();
                    break;
                case 2://按比例缩小后补白
                    $img->widen($thumbwidth);
                    if($img->height() > $thumbheight){
                        $img->heighten($thumbheight);
                    }
                    $img->resizeCanvas($thumbwidth, $thumbheight, 'center', false, 'ffffff');
                    $img->save();
                    break;
                case 3://按比例裁剪
                    $img->fit($thumbwidth, $thumbheight);
                    $img->save();
                    break;
                case 4://按比例裁剪后补白
                default:
                    $img->fit($thumbwidth, $thumbheight);
                    $img->widen($thumbwidth);
                    if($img->height() > $thumbheight){
                        $img->heighten($thumbheight);
                    }
                    $img->resizeCanvas($thumbwidth, $thumbheight, 'center', false, 'ffffff');
                    $img->save();
                    break;
            }
        }
        if($route) {
            list($month, $day, $name) = explode('/',$thumbpath);
            return route('upload.thumb', ['month' => $month, 'day' => $day, 'name' => $name]);
        }else{
            return asset(Storage::disk('public')->url($thumbfolder.$thumbpath));
        }
    }else{
        if($route) {
            list($month, $day, $name) = explode('/', $filepath);
            return route('upload.image', ['month' => $month, 'day' => $day, 'name' => $name]);
        }else {
            return asset(Storage::disk('public')->url($imagefolder.$filepath));
        }
    }
}

function uploadVideo($filepath) {

}

function uploadAudio($filepath) {

}

function getVideoInfo($file) {
    $command = sprintf(config('ffmpeg.ffmpegpath'), $file);
    ob_start();
    passthru($command);
    $info = ob_get_contents();
    ob_end_clean();

    $data = array();
    if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
        $data['duration'] = $match[1]; //播放时间
        $arr_duration     = explode(':', $match[1]);
        $data['seconds']  = $arr_duration[0] * 3600 + $arr_duration[1] * 60 + $arr_duration[2]; //转换播放时间为秒数
        $data['start']    = $match[2]; //开始时间
        $data['bitrate']  = $match[3]; //码率(kb)
    }
    if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
        $data['vcodec']     = $match[1]; //视频编码格式
        $data['vformat']    = $match[2]; //视频格式
        $data['resolution'] = $match[3]; //视频分辨率
        if (strpos($match[3], 'x')) {
            $arr_resolution     = explode('x', $match[3]);
            $data['resolution'] = $match[3];
            $data['width']      = $arr_resolution[0];
            $data['height']     = $arr_resolution[1];
        }
    }
    if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
        $data['acodec']      = $match[1]; //音频编码
        $data['asamplerate'] = $match[2]; //音频采样频率
    }
    if (isset($data['seconds']) && isset($data['start'])) {
        $data['play_time'] = $data['seconds'] + $data['start']; //实际播放时间
    }
    $data['size'] = filesize($file); //文件大小
    return $data;
}