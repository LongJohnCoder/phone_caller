<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TextList extends Model
{
    //
    public $timestamps = true;
	protected $table = 'text_list';
	protected $guarded = array();
}
