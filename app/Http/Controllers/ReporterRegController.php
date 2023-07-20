<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class ReporterRegController extends Controller
{
    public function add(Request $request)
{
    $request->validate([
        'first' => 'required',
        'last' => 'required',
        'role' => 'required',
        'email' => ['required', 'email', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@humbermail\.ca$/'],
        'password' => 'required',
    ]);
    

    $user = new User();
    $user->first = $request->input('first');
    $user->last = $request->input('last');
    $user->role = $request->input('role');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->save();

    return redirect('/console/login')
        ->with('message', 'Congrats on your Reporter Registration!');
}

}
