<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblinvoice extends Model
{
    protected $table = 'tblinvoices';
    protected $primaryKey = 'idinvoice';

    protected $fillable = [
        'idinvoice', 'id','totalmoney', 'discount','exportInvoice','paid'
    ];
}
