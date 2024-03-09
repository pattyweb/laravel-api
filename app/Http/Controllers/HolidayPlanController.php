<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HolidayPlanController extends Controller
{
    public function __construct()
    {
        // Apply the 'auth' middleware to all methods except 'index' and 'show'
        $this->middleware('auth')->except(['generatePdf']);
    }


    public function index()

    {
        // Retrieve holiday plans associated with the authenticated user
        $holidayPlans = Auth::user()->holidayPlans;

        return response()->json($holidayPlans);

    }

    public function show($id)
    {
        return HolidayPlan::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'participants' => 'nullable|array',
        ]);

        if (isset($validatedData['participants'])) {
            $validatedData['participants'] = implode(', ', $validatedData['participants']);
        }

        // Create a new HolidayPlan instance
        $holidayPlan = new HolidayPlan($validatedData);

        // Associate the authenticated user as the creator
        $holidayPlan->creator()->associate(Auth::user());

        // Save the HolidayPlan
        $holidayPlan->save();

        return response()->json($holidayPlan, 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'date' => 'date',
            'location' => 'string|max:255',
            'participants' => 'nullable|array',
        ]);

        // Find the holiday plan by ID
        $holidayPlan = HolidayPlan::findOrFail($id);

        // Check if the authenticated user is the creator of the holiday plan
        if (Auth::user()->id !== $holidayPlan->creator->id) {
            // If not the creator, return an unauthorized response
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // If the authenticated user is the creator, update the holiday plan
        $holidayPlan->update($request->all());

        return response()->json($holidayPlan, 200);
    }


    public function destroy($id)
    {
        // Find the holiday plan by ID
        $holidayPlan = HolidayPlan::findOrFail($id);

        // Check if the authenticated user is the creator of the holiday plan
        if (Auth::user()->id !== $holidayPlan->creator->id) {
            // If not the creator, return an unauthorized response
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // If the authenticated user is the creator, delete the holiday plan
        $holidayPlan->delete();

        return response()->json(['message' => 'Holiday Plan deleted successfully']);
    }


    public function generatePdf($id)
    {
        // Only authenticated users can access this method
        $this->middleware('auth');

        // Retrieve holiday plans based on the given ID
        $user = Auth::user();
        $holidayPlans = $user->holidayPlans;

        // Load the PDF view with the holiday plans
        $pdf = PDF::loadView('holiday_plans', ['holidayPlans' => $holidayPlans]);

        // Return the PDF as a stream
        return $pdf->stream('holiday_plans.pdf');
    }

}
