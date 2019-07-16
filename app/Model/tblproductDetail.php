<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblproductDetail extends Model
{
    protected $table = 'tblproduct_details';
    protected $primaryKey = 'idProDetail';
    public $timestamps = false;

    protected $fillable = [
        'idProDetail','idproduct', 'number','unit', 'price','size','weight','poweCapacity','sold'
    ];
}
