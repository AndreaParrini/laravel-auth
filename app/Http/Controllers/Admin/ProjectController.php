<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all());
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());

        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->title, '-');
        //dd($val_data);

        if ($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $request->cover_image);
            //dd($image_path);
            $val_data['cover_image'] = $image_path;
        }


        //dd($val_data);
        $project = Project::create($val_data);
        if ($request->has('technologies')) {

            $project->technologies()->attach($val_data['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        //dd($project);
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());

        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $image_path = Storage::put('uploads', $request->cover_image);
            //dd($image_path);
            $val_data['cover_image'] = $image_path;
        }

        $project->update($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'Post ' . $project->id . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();

        return to_route('admin.projects.index')->with('message', 'Post  ' . $project->id . '  cancelled successfully');
    }
}
