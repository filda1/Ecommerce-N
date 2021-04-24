<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function scopeCurrentActiveItems($query){

    	if(!setting('site.xd_software')){
    		$items = $query->where("xd_id", NULL)->pluck('id')->toArray();

        	return $query->whereIn('id', $items);
    	}

    	$items = $query->where("xd_id", "!=", NULL)->pluck('id')->toArray();

        return $query->whereIn('id', $items);
    }
}
