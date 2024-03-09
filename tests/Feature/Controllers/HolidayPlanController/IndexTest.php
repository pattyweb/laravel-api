<?php
namespace Tests\Feature\TaskController;

use App\Models\HolidayPlan;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskControllerIndexTest extends TestCase
{
    public function test_authenticated_users_can_fetch_the_task_list(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Creating a sample HolidayPlan
        $holidayPlan = HolidayPlan::factory()
            ->for($user, 'creator')
            ->create([
                "title" => "Fall Vacation",
                "description" => "Enjoying a break in the summer",
                "date" => "2024-07-15",
                "location" => "Rio Resort",
                // Convert participants array to a string
                "participants" => json_encode(["Ian", "Brennan", "Charlie"]),
            ]);

        $route = route('holiday-plans.index');
        $response = $this->getJson($route);

        $response->assertOk()
            ->assertJsonStructure([
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'date',
                        'location',
                        'participants',
                    ],
            ]);
    }

    public function test_unauthenticated_users_can_not_fetch_tasks(): void
    {
        $route = route('holiday-plans.index');
        $response = $this->getJson($route);

        $response->assertUnauthorized();
    }
}
