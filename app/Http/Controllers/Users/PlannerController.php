<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Workout;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlannerController extends Controller
{
    public function index() {

        $workouts = Workout::all();

        return Inertia::render('Planner', [
            'workouts' => $workouts
        ]);
    }
}
