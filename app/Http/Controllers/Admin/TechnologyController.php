<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.technologies.index', ['technologies' => Technology::orderByDesc('id')->paginate(8)]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        //
        //dd($request->all());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($val_data['name'], '-');

        //dd($val_data);

        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology created successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        //
        //dd($request->all());
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($val_data['name'], '-');

        //dd($val_data);

        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'Technology whit ID ' . $technology->id . ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        //
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', 'Technology with ID ' . $technology->id . '  cancelled successfully');
    }
}
