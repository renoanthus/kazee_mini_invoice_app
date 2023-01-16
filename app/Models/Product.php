<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'nama_produk',
        'kode_produk',
        'harga_produk',
        'sisa_stok',
        'foto_produk',
        'keterangan_produk',
    ];

    
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class,'invoice_products','id_invoice','product_id','id','id_invoice');
    }
}
