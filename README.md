Clone the project:
git clone https://github.com/pattyweb/laravel-api.git

Run it on docker:
docker compose up

Run the migration database files:
php artisan migrate

Run the tinker to create dummy content:
php artisan tinker

Create the dummy content:
$u = \App\Models\User::factory()->create();

To run the tests:
php artisan test

To test the endpoints of your HolidayPlanController, you can use tools like Postman, Insomnia, or even cURL. Below are examples of how to test each of your endpoints:

1. Create a new holiday plan (POST):
Endpoint: POST /api/holiday-plans

Payload: JSON data representing a new holiday plan.

Example JSON:

json

Copy code
{
  "title": "Summer Vacation",
  "description": "Enjoying a break in the sun",
  "date": "2024-07-15",
  "location": "Beach Resort",
  "participants": ["Alice", "Bob", "Charlie"]
}

2. Retrieve all holiday plans (GET):
Endpoint: GET /api/holiday-plans

3. Retrieve a specific holiday plan by ID (GET):
Endpoint: GET /api/holiday-plans/{id}

4. Update an existing holiday plan (PUT or PATCH):
Endpoint: PUT /api/holiday-plans/{id} or PATCH /api/holiday-plans/{id}

Payload: JSON data with the fields to update.

Example JSON:

json
Copy code

{
  "title": "Updated Plan",
  "location": "Updated Location"
}

5. Delete a holiday plan (DELETE):
Endpoint: DELETE /api/holiday-plans/{id}

6. Generate PDF for a specific holiday plan (GET):
Endpoint: GET /api/holiday-plans/{id}/generate-pdf
