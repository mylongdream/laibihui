<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmRewardExchangeModel extends Model
{
	protected $table = 'crm_reward_exchange';
	protected $primaryKey = 'id';
	public $timestamps = true;

    public function reward()
    {
        return $this->belongsTo('App\Models\CrmRewardModel', 'reward_id');
    }

}
