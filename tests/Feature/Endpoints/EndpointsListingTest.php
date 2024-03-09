<?php
// EndpointsListingTest.php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\HolidayPlan;
use Laravel\Sanctum\Sanctum;

class EndpointsListingTest extends TestCase
{
    use RefreshDatabase; // Add this trait to reset the database for each test

    /**
     * Test the availability of the /api/holiday-plans/{holiday_plan} endpoint.
     *
     * @return void
     */
    public function testShowHolidayPlanEndpointAvailability()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs($user);

        // Create a holiday plan with the authenticated user as the creator
        $holidayPlan = HolidayPlan::factory()->create(['creator_id' => $user->id]);

        // Make a request to the show endpoint
        $response = $this->get("/api/holiday-plans/{$holidayPlan->id}");

        // Assert that the response has a successful status code
        $response->assertStatus(200);
    }
}
