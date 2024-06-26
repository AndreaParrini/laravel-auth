<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.types.index', ['types' => Type::orderByDesc('id')->paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        //dd($request->validated());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($val_data['name'], '-');

        //dd($val_data);
        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //$allProjectsType = $type->projects;
        $allProjectsType = Project::where('type_id', $type->id)->paginate(8);
        return view('admin.types.show', compact('allProjectsType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //dd($request->validated());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($val_data['name'], '-');

        //dd($val_data);
        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'Type whit ID ' . $type->id . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
        $type->delete();

        return to_route('admin.types.index')->with('message', 'Post with ID ' . $type->id . '  cancelled successfully');
    }
}
