<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $primaryKey = 'idComponent';
    public $timestamps = false;

    protected $fillable = [
        'idComponent', 'nameComp', 'idStyle','idSubComp','parentComp','classComp','orderComp'
    ];
    public function getstylesheet(){
    	return $this->hasOne(Stylesheet::class,'idStyle');
    }
    public function getstylesheets(){
    	return $this->hasMany(Stylesheet::class,'idStyle');
    }
}
