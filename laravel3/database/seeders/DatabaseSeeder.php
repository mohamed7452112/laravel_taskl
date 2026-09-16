<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();
        
        Category::factory(5)->create()->each(function ($category) {
            Product::factory(3)->create([
                'category_id' => $category->id
            ]);
        });

        Order::factory(5)->create()->each(function ($order) {
            OrderItem::factory(2)->create([
                'order_id' => $order->id
            ]);
        });
    }
}