<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        session()->flash('success', 'Registro creado exitosamente');

        return redirect()->route('users.index');
    }

    public function edit(Request $request, User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        session()->flash('success', 'Registro modificado exitosamente');

        return redirect()->route('users.index');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        session()->flash('success', 'Registro eliminado exitosamente');

        return redirect()->route('users.index');
    }
}
