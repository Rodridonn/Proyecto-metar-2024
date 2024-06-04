<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('layouts.users.index', compact('users'));
    }

    public function create()
    {
        return view('crearusuario.create-user');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'nullable|string|max:255',
            'password' => 'required|string|min:5|confirmed',
        ]);
    
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = bcrypt($request->input('password'));
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'El usuario se creó correctamente.');
    }
    

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('layouts.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validación para otros campos
    $this->validate($request, [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:255',
    ]);

    // Actualización de campos sin contraseña
    $user->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
    ]);

    // Actualización de contraseña solo si se proporciona una nueva
    if ($request->filled('password')) {
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
    }

    return redirect()->route('users.index')->with('success', 'Los cambios se guardaron correctamente.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
    
        // Desactivar eventos de Spatie Permission temporalmente
        User::withoutEvents(function () use ($user) {
            $user->delete();
        });
    
        return redirect()->route('users.index')->with('success', 'El usuario se eliminó correctamente.');
    }


}
