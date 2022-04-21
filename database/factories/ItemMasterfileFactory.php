<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemMasterfile;
use Faker\Generator as Faker;

$factory->define(ItemMasterfile::class, function (Faker $faker) {
    return [
        'product_name' => $faker->product_name,
        'product_shrt_name' => $faker->product_shrt_name,
        'description' => $faker->description,
        'company_code' => $faker->company_code,
        'itemcode' => $faker->itemcode,
        'barcode' => $faker->barcode,
        'brand' => $faker->brand,
        'principal' => $faker->principal,
        'product_family' => $faker->product_family,
        'keywords' => $faker->keywords,
        'uom' => $faker->uom,
        'list_price_wouttax' => $faker->list_price_wouttax,
        'list_price_wtax' => $faker->list_price_wtax,
        'conversion_qty' => $faker->conversion_qty,
        'conversion_uom' => $faker->uom,
    ];
});
