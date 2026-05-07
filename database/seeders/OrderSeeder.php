<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->first() ?? User::factory()->create();

        Order::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
