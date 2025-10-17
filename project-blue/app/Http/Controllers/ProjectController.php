<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    private $rules = [
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:10|max:1000',
        'owner_id' => 'required|numeric|min:1|max:99999999999999999999'
    ];

    private $traductionAttributes = [
        'title' => 'título',
        'description' => 'descripción',
        'owner_id' => 'propietario'
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
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
            return redirect()->route('projects.create')->withInput()->withErrors($errors);
        }

        $project = Project::create($request->all());
        session()->flash('message', 'Registro creado exitosamente');
        return redirect()->route('projects.index');
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
        $project = Project::find($id);
        if($project)//el proyecto existe
        {
            return view('project.edit', compact('project'));
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
            return redirect()->route('projects.index');
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
            return redirect()->route('projects.edit', $id)->withInput()->withErrors($errors);
        }

        $project = Project::find($id);
        if($project)//el proyecto existe
        {
            $project->update($request->all());
            session()->flash('message', 'Registro actualizado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
        }
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if($project)//el proyecto existe
        {
            $project->delete();
            session()->flash('message', 'Registro eliminado exitosamente');
        }
        else
        {
            session()->flash('warning', 'No se encuentra el registro solicitado');
        }
        
        return redirect()->route('projects.index');
    }
}