<?php

namespace App\Models;

use HaoLi\LaravelAmount\Traits\AmountTrait;
use Illuminate\Database\Eloquent\Model;

class CommonRedpackModel extends Model
{
    use AmountTrait;

	protected $table = 'common_redpack';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $dates = ['use_start', 'use_end'];
    protected $amountFields = ['amount', 'fullamount'];

}
