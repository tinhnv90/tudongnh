<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblinvoiceDetail extends Model
{
    protected $table = 'tblinvoice_details';
    protected $primaryKey = 'idInvoiceDetail';
    public $timestamps = false;

    protected $fillable = [
        'idInvoiceDetail', 'idproduct', 'idinvoice','number','discount',
    ];

    public function getProduct(){
        return $this->belongsTo(tblproduct::class,'idproduct');
    }
}
