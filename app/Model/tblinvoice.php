<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tblinvoice extends Model
{
    protected $table = 'tblinvoices';
    protected $primaryKey = 'idinvoice';

    protected $fillable = [
        'idinvoice', 'id','code','recipientName','recipientPhone','recipientAdress','totalmoney', 'discount','exportInvoice','paid'
    ];
}
