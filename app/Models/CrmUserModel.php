<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CrmUserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'crm_user';
	protected $primaryKey = 'uid';
	public $timestamps = true;
	protected $dates = ['lastlogin'];

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop()
    {
        return $this->belongsTo('App\Models\BrandShopModel', 'shop_id');
    }

}
