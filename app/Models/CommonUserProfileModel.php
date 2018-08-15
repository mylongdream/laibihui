<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonUserProfileModel extends Model
{
	protected $table = 'common_user_profile';
	protected $primaryKey = 'uid';
	public $timestamps = true;
    protected $dates = ['birthday'];
    protected $fillable = ['uid'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function getworkprovince()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'workprovince', 'id');
    }

    public function getworkcity()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'workcity', 'id');
    }

    public function getworkarea()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'workarea', 'id');
    }

    public function getworkstreet()
    {
        return $this->belongsTo('App\Models\CommonDistrictModel', 'workstreet', 'id');
    }

}
