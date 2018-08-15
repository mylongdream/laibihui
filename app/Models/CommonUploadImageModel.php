<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonUploadImageModel extends Model
{
	use SoftDeletes;
	protected $table = 'common_upload_image';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $dates = ['deleted_at'];


}
