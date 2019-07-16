<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblproducer extends Model
{
    protected $table = 'tblproducers';
    protected $primaryKey = 'idProducer';
    public $timestamps = false;

    protected $fillable = [
        'idProducer', 'nameProducer', 'pathProducer','contentProducer','idImg','emailProducer','phoneProducer','adressProducer'
    ];
}
