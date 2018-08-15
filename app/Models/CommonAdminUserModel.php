<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CommonAdminUserModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'common_admin_user';
	protected $primaryKey = 'uid';
	public $timestamps = true;
	protected $dates = ['lastlogin'];

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\CommonAdminGroupModel', 'group_id');
    }

}
