<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblimage extends Model
{
    protected $table = 'tblimages';
    protected $primaryKey = 'idImg';
    public $timestamps = false;

    protected $fillable = [
        'idImg', 'altImg', 'pathImg','srcImg','srcImgBig'
    ];
}
