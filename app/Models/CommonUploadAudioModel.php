<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonUploadAudioModel extends Model
{
	use SoftDeletes;
	protected $table = 'common_upload_audio';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $dates = ['deleted_at'];


}
