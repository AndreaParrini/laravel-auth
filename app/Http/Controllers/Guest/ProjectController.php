<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('guests.projects.index', ['projects' => Project::orderByDesc('id')->paginate(8)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return view('guests.projects.show', compact('project'));
    }
}
