<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonSettingModel extends Model
{
	protected $table = 'common_setting';
	protected $primaryKey = 'skey';
	public $timestamps = false;

	protected $fillable = ['skey'];

}
