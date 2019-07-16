<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblseo extends Model
{
    protected $table = 'tblseos';
    protected $primaryKey = 'idSeo';
    public $timestamps = false;

    protected $fillable = [
        'idSeo', 'metaTag','tags', 'description','keyword','idbanner', 'idcategory','idPost', 'idProducer','idproduct','idinfoweb'
    ];
}
