<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\Workout;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\Week;
use App\Models\Users\Day;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Error', ['status' => 404]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkoutRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);

        Workout::create([
            'name' => $data['name'],
            'slug' => $slug,
            'user_id' => $data['user_id']
        ]);
        
        return redirect()->route('workouts.show', ['workout' => $slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $workout = Workout::where('slug', $slug)->firstOrFail();
        $weeks = Week::where('workout_id', $workout->id)->get();
        $days = [];

        foreach ($weeks as $week) {
            $days[] = Day::where('week_id', $week->id)->get();
        };

        return Inertia::render('Workouts/Show', [
            'workout' => $workout,
            'weeks' => $weeks,
            'days' => $days
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        //
    }
}
