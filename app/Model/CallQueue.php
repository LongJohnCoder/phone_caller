<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallQueue extends Model
{
    //
    public $timestamps = true;
	protected $table = 'call_queue';
	protected $guarded = array();
}
