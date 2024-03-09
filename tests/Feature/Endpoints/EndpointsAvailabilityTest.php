<?php

namespace Tests\Feature\EndpointsAvailability;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class EndpointsAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the availability of the GET request for /api/holiday-plans.
     *
     * @return void
     */
    public function testGetEndpointAvailability()
    {
        // Authenticate the user
        Sanctum::actingAs(User::factory()->create());

        // Make a GET request to the endpoint
        $response = $this->get('/api/holiday-plans');

        // Assert that the response has a successful status code
        $response->assertStatus(200);
    }

    /**
     * Test the availability of the POST request for /api/holiday-plans.
     *
     * @return void
     */
    public function testPostEndpointAvailability()
    {
        // Authenticate the user
        Sanctum::actingAs(User::factory()->create());

        // Mock data for the POST request
        $postData = [
            'title' => 'Test Holiday Plan',
            'description' => 'This is a test holiday plan.',
            'date' => '2024-03-10', // Provide a valid date
            'location' => 'Test Location', // Provide a valid location
            // Add other required fields
        ];

        // Make a POST request to the endpoint with the mock data
        $response = $this->post('/api/holiday-plans', $postData);

        // Assert that the response has the expected status code (201 for a successful creation)
        $response->assertCreated()->assertRedirect();
    }
}
