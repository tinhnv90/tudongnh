<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblpost extends Model
{
    protected $table = 'tblposts';
    protected $primaryKey = 'idPost';

    protected $fillable = [
        'idPost', 'id', 'idcategory','titlePost' ,'pathPost','shortDescription' ,'idImg','contentPost','numview','status','quote'
    ];

    public function getImages(){
    	return $this->belongsTo(tblimage::class,'idImg');
    }
    public function getSeo(){
        return $this->hasOne(tblseo::class,'idproduct');
    }
}
