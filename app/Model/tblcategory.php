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
    public function imagescategory(){
        return $this->belongsTo(tblimage::class,'idImg');
    }
}
