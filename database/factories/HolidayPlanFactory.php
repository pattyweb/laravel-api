<?php

namespace Database\Factories;

use App\Models\HolidayPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class HolidayPlanFactory extends Factory
{
    protected $model = HolidayPlan::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'creator_id' => User::factory()->create()->id

        ];
    }
}
