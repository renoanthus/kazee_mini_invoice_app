<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id_invoice';
    public $incrementing = false;

    protected $fillable = [
        'id_invoice',
        'tanggal_invoice',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'invoice_products','id_invoice','product_id')->withPivot('jumlah','harga','total_harga');
    }

}
