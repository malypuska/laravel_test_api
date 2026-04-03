<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for($i = 1; $i <=10; $i++) {
            $data = [
                'title' => "title{$i}",
                'description' => "description{$i}",
                'status' => 'active',
            ];
            
            Task::create($data);
        }
        
        // User::factory(10)->create();
/*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
