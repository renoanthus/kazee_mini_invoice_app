<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        $harga=array(4000,7000,12000,10000,15000,20000);
        $sisa_stok=array(100,200,300,400,500,600);
        $random_keys=array_rand($harga,2);
        return [
            'kode_produk'=>Str::random(10),
            'nama_produk'=>fake()->word(),
            'keterangan_produk'=>fake()->paragraph(),
            'sisa_stok'=>$sisa_stok[$random_keys[0]],
            'harga_produk'=>$harga[$random_keys[0]],
            'foto_produk'=>'images/img_placeholder.jpeg',
        ];
    }
}