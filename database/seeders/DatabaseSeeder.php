<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;
use App\Models\Room;
use App\Models\RoomCategory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        DB::table('room_categories')->insert([
            ['category' => 'Premium Deluxe', 'base_price' => 12000.00, 'created_at' => now(),'updated_at' => now()],
            ['category' => 'Super Deluxe', 'base_price' => 10000.00, 'created_at' => now(),'updated_at' => now()],
            ['category' => 'Standard Deluxe', 'base_price' => 8000.00, 'created_at' => now(),'updated_at' => now()],
        ]);
        $categories = RoomCategory::all();
        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                Room::create([
                    'room_number' => 'HG' . $category->id . Random::generate(2, '0-9'),
                    'room_category_id' => $category->id,
                    'image_path' => null,
                ]);
            }
        }
        
    }
}
