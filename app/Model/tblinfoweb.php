<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblinfoweb extends Model
{
    protected $table = 'tblinfowebs';
    protected $primaryKey = 'idinfoweb';
    public $timestamps = false;

    protected $fillable = [
        'idinfoweb', 'name', 'theme', 'phone','email','adress','facebook','youtube', 'google','twitter','imglogo','imgicon'
    ];
}
