<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AudioTextDirectoryCallMap extends Model
{
    //
    public $timestamps = true;
	protected $table = 'audio_text_directory_call_map';
	protected $guarded = array();
		
		
		public function audio()
    {
        return $this->belongsTo(AudioList::class, 'audio_id');
    }
		public function text()
    {
        return $this->belongsTo(TextList::class, 'text_id');
    }

}
