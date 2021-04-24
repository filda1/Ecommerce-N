<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Spatial;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    protected $dates = ['deleted_at'];
    use Spatial;
    protected $spatial = ['localizacao'];
}
