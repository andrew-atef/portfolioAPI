<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{


    public function createAPI(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description'  => $request->description
        ]);

        foreach($request->file('images') as $key => $image){
            $path = $image->store('projects','public');
            Image::create([
                'url' => $path,
                'state' => $key == 0 ? 'thumbnail' : 'image',
                'project_id' => $project->id,
            ]);
        }

        return $project;
    }

    /**
     * Display a listing of the resource.
     */
    public function indexApi()
    {
        $projects = Project::with('images')->get();
        return $projects;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
