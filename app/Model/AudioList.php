<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AudioList extends Model
{
    //
    public $timestamps = true;
	protected $table = 'audio_list';
	protected $guarded = array();
}
