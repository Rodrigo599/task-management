<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('projects.create');
    }

    public function edit()
    {
        return view('projects.edit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255']
        ]);

        $data['user_id'] = auth()->id();

        Project::create($data);

        return redirect()->route('home')
            ->with('success', 'Project successfully created');
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => ['string', 'max:255']
        ]);

        $project->update($data);

        return redirect()->route('home')
            ->with('success', 'Project successfully updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('home')
            ->with('success', 'Project deleted');
    }
}
