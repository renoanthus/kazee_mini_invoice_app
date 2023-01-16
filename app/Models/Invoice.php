<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    protected $fillable = [
        'id_invoice',
        'tanggal_invoice',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'invoice_products','id_invoice','product_id');
    }

}
