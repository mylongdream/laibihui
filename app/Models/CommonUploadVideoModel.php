<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonUploadVideoModel extends Model
{
	use SoftDeletes;
	protected $table = 'common_upload_video';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $dates = ['deleted_at'];


}
