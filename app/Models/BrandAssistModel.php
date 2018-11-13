<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HaoLi\LaravelAmount\Traits\AmountTrait;

class BrandAssistModel extends Model
{
    use AmountTrait;

    protected $table = 'brand_assist';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $amountFields = ['price'];

}
