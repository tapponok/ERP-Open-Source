<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     Product::create([
    //         'product_name' => 'Sneakers Hasa',
    //         'product_code' => 'SH',
    //         'sku' => 'SH-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 100000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Boots',
    //         'product_code' => 'BO',
    //         'sku' => 'BO-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 200000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Nike Sports',
    //         'product_code' => 'NS',
    //         'sku' => 'NS-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 250000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Addidas sports',
    //         'product_code' => 'AS',
    //         'sku' => 'AS-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 352500,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Puma sports',
    //         'product_code' => 'PS',
    //         'sku' => 'PS-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 850500,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Sneakers Puma',
    //         'product_code' => 'SP',
    //         'sku' => 'SP-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 235000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Sneakers Addidas',
    //         'product_code' => 'SAD',
    //         'sku' => 'SAD-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 455000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Sneakers Puma Limited',
    //         'product_code' => 'SPL',
    //         'sku' => 'PL-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 456000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Sneakers Brodo Coll',
    //         'product_code' => 'SBC',
    //         'sku' => 'SBC-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 1000000,
    //         'created_by' => 1,
    //     ]);
    //     Product::create([
    //         'product_name' => 'Earth Origins Shoes',
    //         'product_code' => 'EOS',
    //         'sku' => 'EOS-001',
    //         'category_id' => 1,
    //         'unit_id' => 3,
    //         'garage_id'=> 1,
    //         'minimum_stock' => 100,
    //         'selling_price' => 1500000,
    //         'created_by' => 1,
    //     ]);
    // }

    public function run()
    {
        $adjectives = ["Active", "Elegant", "Dynamic", "Modern", "Urban", "Sleek", "Vibrant", "Sporty", "Adventure", "Stylish"];
        $nouns = ["Runner", "Glide", "Trekker", "Walker", "Sprinter", "Hiker", "Jogger", "Explorer", "Traveler", "Pacer"];
        $styles = ["Max", "Pro", "Elite", "Boost", "X", "Flex", "Ultra", "Grip", "Quick", "Swift"];

        $numberOfProducts = 1000;
        $faker = Faker::create();

        for ($i = 0; $i < $numberOfProducts; $i++) {
            $randomAdjective = $adjectives[array_rand($adjectives)];
            $randomNoun = $nouns[array_rand($nouns)];
            $randomStyle = $styles[array_rand($styles)];

            $productName = $randomAdjective . " " . $randomNoun . " " . $randomStyle;

            Product::create([
                'product_name' => $productName,
                'product_code' => $faker->ean13(),
                'sku' => $faker->ean8(),
                'category_id' => $faker->numberBetween(1, 4),
                'unit_id' => $faker->numberBetween(1, 4),
                'garage_id' => $faker->numberBetween(1, 5),
                'minimum_stock' => $faker->numberBetween(50, 200),
                'selling_price' => $faker->randomElement([10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000]),
                'created_by' => $faker->randomElement([1, 2, 3]),
            ]);
        }
        Product::create([
            'product_name' => 'Sneakers Hasa',
            'product_code' => 'SH',
            'sku' => 'SH-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 100000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Boots',
            'product_code' => 'BO',
            'sku' => 'BO-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 200000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Nike Sports',
            'product_code' => 'NS',
            'sku' => 'NS-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 250000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Addidas sports',
            'product_code' => 'AS',
            'sku' => 'AS-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 352500,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Puma sports',
            'product_code' => 'PS',
            'sku' => 'PS-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 850500,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Sneakers Puma',
            'product_code' => 'SP',
            'sku' => 'SP-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 235000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Sneakers Addidas',
            'product_code' => 'SAD',
            'sku' => 'SAD-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 455000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Sneakers Puma Limited',
            'product_code' => 'SPL',
            'sku' => 'PL-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 456000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Sneakers Brodo Coll',
            'product_code' => 'SBC',
            'sku' => 'SBC-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 1000000,
            'created_by' => 1,
        ]);
        Product::create([
            'product_name' => 'Earth Origins Shoes',
            'product_code' => 'EOS',
            'sku' => 'EOS-001',
            'category_id' => 1,
            'unit_id' => 3,
            'garage_id' => 1,
            'minimum_stock' => 100,
            'selling_price' => 1500000,
            'created_by' => 1,
        ]);
    }
}
