<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register'); // Regular user registration form
    }

    /**
     * Handle an incoming regular user registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'array'], // Ensure at least one role is selected
            'role.*' => [
                'required',
                Rule::in(['super-admin', 'admin', 'alumni']), // Updated roles
            ],
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Assign roles
        foreach ($request->role as $role) {
            $user->assignRole($role); // Assuming you have a method to assign roles
        }
    
        event(new Registered($user));
    
        // Redirect to login with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    
    
}
