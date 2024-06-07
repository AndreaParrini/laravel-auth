<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Project::with(['technologies', 'type'])->orderByDesc('id')->paginate(6)
        ]);
    }

    public function show($id)
    {
        $project = Project::with(['technologies', 'type'])->where('id', $id)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => '404! Project NOT Found'
            ]);
        }
    }
}
