<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class tblhtml extends Model
{
    protected $table = 'tblhtmls';
    protected $primaryKey = 'idhtml';
    public $timestamps = false;

    protected $fillable = [
        'idhtml', 'descript', 'properties','value',
    ];
}
