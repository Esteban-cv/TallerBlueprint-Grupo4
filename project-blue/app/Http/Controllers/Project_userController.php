<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project_userStoreRequest;
use App\Http\Requests\Project_userUpdateRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class Project_userController extends Controller
{
    public function index(Request $request)
    {
        $projectUsers = ProjectUser::all();

        return view('projectUser.index', [
            'projectUsers' => $projectUsers,
        ]);
    }

    public function create(Request $request)
    {
        $projects = Project::all();
        $users = User::all();

        return view('projectUser.create', compact('projects', 'users'));
    }

    public function store(Project_userStoreRequest $request)
    {
        $projectUser = ProjectUser::create($request->validated());
        session()->flash('success', 'Usuario agregado al proyecto correctamente.');

        return redirect()->route('projectUsers.index');
    }

    public function edit(Request $request, ProjectUser $projectUser)
    {
        $projects = Project::all();
        $users = User::all();

        return view('projectUser.edit', [
            'projectUser' => $projectUser,
            'projects' => $projects,
            'users' => $users,
        ]);
    }

    public function update(Project_userUpdateRequest $request, ProjectUser $projectUser)
    {
        $projectUser->update($request->validated());
        session()->flash('success', 'Asignación actualizada correctamente.');

        return redirect()->route('projectUsers.index');
    }

    public function destroy(Request $request, ProjectUser $projectUser)
    {
        $projectUser->delete();
        session()->flash('success', 'Asignación eliminada correctamente.');

        return redirect()->route('projectUsers.index');
    }
}
