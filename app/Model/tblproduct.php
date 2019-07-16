<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblproduct extends Model
{
    protected $table = 'tblproducts';
    protected $primaryKey = 'idproduct';
    //protected $dateFormat = 'd-m-Y';

    protected $fillable = [
        'idproduct', 'idcategory','idProducer', 'namePro','pathPro','codepro','idImg','moreImg','contentPro','numview','statusPro'
    ];
    public function getproductDetail(){
    	return $this->hasOne(tblproductDetail::class,'idproduct');
    }
    public function getproductImages(){
    	return $this->belongsTo(tblimage::class,'idImg');
    }
    public function listproducthome(){
        
    }
}
