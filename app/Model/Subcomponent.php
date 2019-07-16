<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subcomponent extends Model
{
    protected $table = 'subcomponents';
    protected $primaryKey = 'idSubComp';
    public $timestamps = false;

    protected $fillable = [
        'idSubComp', 'nameSubComp', 'pathSubComp','srcSubComp'
    ];
}
