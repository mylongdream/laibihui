<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class CommonUserCardModel extends Model
{
    use AmountTrait;

    protected $table = 'common_user_card';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['money'];

    public function user()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'uid');
    }

    public function fromuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromuid', 'uid');
    }

    public function fromupuser()
    {
        return $this->belongsTo('App\Models\CommonUserModel', 'fromupuid', 'uid');
    }

    public function card()
    {
        return $this->belongsTo('App\Models\CommonCardModel', 'number', 'number');
    }

}
