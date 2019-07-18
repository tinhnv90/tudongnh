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
    public function getDetail(){
    	return $this->hasOne(tblproductDetail::class,'idproduct');
    }
    public function getImages(){
    	return $this->belongsTo(tblimage::class,'idImg');
    }
    public function getmoreImages(){
        return [1,2,3,4,5,6];
    }
    public function getSeo(){
        return $this->hasOne(tblseo::class,'idproduct');
    }
}
