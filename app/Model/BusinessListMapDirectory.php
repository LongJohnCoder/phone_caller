<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessListMapDirectory extends Model
{
    //
    public $timestamps = true;
	protected $table = 'business_list_map_directory';
	protected $guarded = array();
	public function buisness_details()
    {
        return $this->belongsTo(BusinessListing::class, 'business_list_id');
    }

}
