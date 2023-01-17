<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Invoice::class;
    public function definition()
    {
        $invoice = Invoice::create(
            [
                'id_invoice'=> 'iv'.Str::random(6),
                'tanggal_invoice'=> Carbon::now()->format('Y-m-d'),
            ]
        );
        $invoice->products()->detach();
        
        $jumlah=array(20,30,10,4,5,8);
        $random_keys=array_rand($jumlah,2);
        
        $produk = Product::take(4)->get();
        foreach ($produk as $key => $value) {
            $invoice->products()->attach($value,[
                'jumlah' => $jumlah[$random_keys[0]],
                'harga' => $value->harga_produk,
                'total_harga' => $jumlah[$random_keys[0]]*$value->harga_produk,
            ]);
        }
        return [
            'id_invoice'=> 'iv'.Str::random(6),
            'tanggal_invoice'=> Carbon::now()->format('Y-m-d'),
        ];
    }
}