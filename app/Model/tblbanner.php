<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblbanner extends Model
{
    protected $table = 'tblbanners';
    protected $primaryKey = 'idbanner';

    protected $fillable = [
        'idbanner', 'nameBn', 'pathBn' ,'idImg','type','listIdProduct','promotion','status',
    ];

    public function getImages(){
    	return $this->belongsTo(tblimage::class,'idImg');
    }
    public function getSeo(){
        return $this->hasOne(tblseo::class,'idproduct');
    }
}
