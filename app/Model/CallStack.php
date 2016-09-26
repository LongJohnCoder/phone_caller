<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallStack extends Model
{
    //
    public $timestamps = true;
	protected $table = 'call_stack';
	protected $guarded = array();
}
