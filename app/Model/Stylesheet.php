<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stylesheet extends Model
{
    protected $table = 'stylesheets';
    protected $primaryKey = 'idStyle';
    public $timestamps = false;

    protected $fillable = [
        'idStyle', 'attrid', 'attrclass','padding','margin','border','border_radius','float', 'background', 'width','height','font_size','font_weight','font_type','color'
    ];
}
