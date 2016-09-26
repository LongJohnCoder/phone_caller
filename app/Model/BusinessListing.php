<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    //
    public $timestamps = true;
	protected $table = 'business_listing';
	protected $guarded = array();
}
