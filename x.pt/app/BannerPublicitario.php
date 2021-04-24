<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BannerPublicitario extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = 'banner_publicitario';
}
