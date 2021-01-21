<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=1; $i <100 ; $i++) { 
            
            DB::table('products')->insert([
                'name' => $faker->company,
                'brand_id' => $faker->numberBetween(3, 15),
                'category_id' => $faker->numberBetween(11,13),
                'price' => $faker->numberBetween(100000, 10000000),
                'stock' => $faker->numberBetween(10, 100),
                'weight' => $faker->numberBetween(100, 5000),
                'description' => $faker->word(),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'condition' => $faker->randomElement(['baru', 'bekas'])
            ]);
        }
    }
}
