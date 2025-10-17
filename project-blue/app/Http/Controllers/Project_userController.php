<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Project_userController extends Controller
{

    private $rules = [
        'project_id' => 'required|numeric|min:1|max:99999999999999999999',
        'user_id' => 'required|numeric|min:1|max:99999999999999999999',
        'role' => 'required|string|min:2|max:50'
    ];

    private $traductionAttributes = [
        'project_id' => 'proyecto',
        'user_id' => 'usuario',
        'role' =>  'rol'
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectUsers = ProjectUser::all();
        return view('projectUser.index', compact('projectUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('projectUser.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return redirect()->route('projectUsers.create')->withInput()->withErrors($errors);
        }

        $projectUser = ProjectUser::create($request->all());
        session()->flash('message', 'Registro creado exitosamente');
        return redirect()->route('projectUsers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projectUser = ProjectUser::find($id);
        if($projectUser)//la asignación existe
        {
            $projects = Project::all();
            $users = User::all();
            return view('projectUser.edit', compact('projectUser', 'projects', 'users'));
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('projectUsers.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), $this->rules);
        $validator->setAttributeNames($this->traductionAttributes);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return redirect()->route('projectUsers.edit', $id)->withInput()->withErrors($errors);
        }

        $projectUser = ProjectUser::find($id);
        if($projectUser)//la asignación existe
        {
            $projectUser->update($request->all());
            session()->flash('message', 'Registro actualizado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
        }
        return redirect()->route('projectUsers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projectUser = ProjectUser::find($id);
        if($projectUser)//la asignación existe
        {
            $projectUser->delete();
            session()->flash('message', 'Registro eliminado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
        }
        
        return redirect()->route('projectUsers.index');
    }
}