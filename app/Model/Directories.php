<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Directories extends Model
{
    //
    public $timestamps = true;
	protected $table = 'directories';
	protected $guarded = array();
}
