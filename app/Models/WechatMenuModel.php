<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatMenuModel extends Model
{
	protected $table = 'wechat_menu';
	protected $primaryKey = 'id';
	public $timestamps = false;

    public function publish($tag_id = 0)
    {
        $menulist = WechatMenuModel::where('tag_id', $tag_id)->orderBy('displayorder', 'asc')->get();
        if(!$menulist) {
            return false;
        }
        $pubmenu = [];
        foreach($menulist as $key => $value) {
            if(!$value->parentid) {
                $sub_button = [];
                foreach($menulist as $k => $val) {
                    if($val->parentid == $value->id) {
                        $item = [
                            'type' => $val->type,
                            'name' => $val->name
                        ];
                        if($val->type == 'view') {
                            $item['url'] = $val->url;
                        }elseif($val->type == 'miniprogram') {
                            $item['url'] = $val->url;
                            $item['appid'] = $val->appid;
                            $item['pagepath'] = $val->pagepath;
                        }else{
                            $item['key'] = $val->type.$val->id;
                        }
                        $sub_button[] = $item;
                        unset($menulist[$k]);
                    }
                }
                if($sub_button){
                    $item = [
                        'name' => $value->name,
                        'sub_button' => $sub_button
                    ];
                }else{
                    $item = [
                        'type' => $value->type,
                        'name' => $value->name
                    ];
                    if($value->type == 'view') {
                        $item['url'] = $value->url;
                    }elseif($value->type == 'miniprogram') {
                        $item['url'] = $value->url;
                        $item['appid'] = $value->appid;
                        $item['pagepath'] = $value->pagepath;
                    }else{
                        $item['key'] = $value->type.$value->id;
                    }
                }
                $pubmenu[] = $item;
            }
        }
        $app = app('wechat.official_account');
        if($tag_id){
            return $app->menu->create($pubmenu, ['tag_id' => $tag_id]);
        }else{
            return $app->menu->create($pubmenu);
        }
    }

}
