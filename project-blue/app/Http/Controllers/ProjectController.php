<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();

        return view('project.index', [
            'projects' => $projects,
        ]);
    }

    public function create(Request $request)
    {
        return view('project.create');
    }

    public function store(ProjectStoreRequest $request)
    {
        $project = Project::create($request->validated());
        session()->flash('success', 'Registro creado exitosamente');
        return redirect()->route('projects.index');
    }

    public function edit(Request $request, Project $project)
    {
        return view('project.edit', [
            'project' => $project,
        ]);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
        session()->flash('success', 'Registro modificado exitosamente');
        return redirect()->route('projects.index');
    }

    public function destroy(Request $request, Project $project)
    {
        $project->delete();
        session()->flash('success', 'Registro eliminado exitosamente');
        return redirect()->route('projects.index');
    }
}
