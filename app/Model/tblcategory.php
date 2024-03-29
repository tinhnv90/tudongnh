<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblcategory extends Model
{
    protected $table = 'tblcategories';
    protected $primaryKey = 'idcategory';
    public $timestamps = false;

    protected $fillable = [
        'idcategory', 'titleCt', 'pathCt','idImg','typeCt','leveCt','orderCt','statusCt','showproducthome'
    ];
    public function children(){
    	return $this->hasMany(self::class,'leveCt');
    }
    public function parentcategory(){
        return $this->belongsTo(self::class,'leveCt');
    }
    public function listproduct(){
    	return $this->hasMany(tblproduct::class,'idcategory');
    }
    public function listpost(){
        return $this->hasMany(tblpost::class,'idcategory');
    }
    public function getImages(){
        return $this->belongsTo(tblimage::class,'idImg');
    }
    public function getSeo(){
        return $this->hasOne(tblseo::class,'idcategory');
    }
}
