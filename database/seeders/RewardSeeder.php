<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reward_a = new Reward(); 
        $reward_a->name = "Reward A";
        $reward_a->point = 20;
        $reward_a->reward = 20;
        $reward_a->save();

        $reward_b = new Reward(); 
        $reward_b->name = "Reward B";
        $reward_b->point = 40;
        $reward_b->reward = 40;
        $reward_b->save();
    }
}
