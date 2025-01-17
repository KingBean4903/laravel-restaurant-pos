<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    //
    // Handle the login process
    public function login(Request $request)
    {
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    
        // Retrieve the user by email
        // $user = User::where('email', $request->email)->first();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true) ){
            $request->session()->regenerate();

            //return redirect()->route('checkout');
        
    
        //if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);
    
            // Regenerate the session
            //$request->session()->regenerate();
    
            // Redirect to the dashboard
            return redirect()->route('/');
        }
    
        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('menu');
    }

     // Handle Registration
     public function register(Request $request)
     {
        try {
            // Validate Input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            // Create the User
            User::create([
                'name' => $validated['name'],
                'role' => 'ADMIN',
                'pin' => 0000,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']), // Hash the password
            ]);

            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');

        } catch(Exception $e) {
            
            return response()
                        ->json(['Error' => $e->getMessage()], 500);

        }
         // Redirect to the login page
         
     }
 
     public function store(Request $request)
     {
         try {
 
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role'=> 'required|string',
                'pin' => 'nullable|numeric|integer|min_digits:4|max_digits:4', // Only required for cashiers
            ]);
    
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'pin' => $validated['pin'],
            ]);
    
    
            return redirect()->route('users')->with('success', 'User created successfully.');
    
        } catch(Exception $e) {
    
    
            return response()
                            ->json([ 'Error' => $e->getMessage()], 500);
    
        }
       
         
     }

     function loginPage() {
         return view('components.login-page');
     }

     // updateUser : User update handler function
     function updateUser(Request $request, User $user)
     {
        try {
            $validated = $request->validate([
                'name' => 'string|max:255',
                'phone' => 'string',
                'role'  => 'string',
                'pin' => 'nullable|numeric|integer|min_digits:4|max_digits:4',
                'password' => 'string|min:8',
            ]);
            
            $user->update([
                'name' => $validated['name'] == " " ? $user->name : $validated['name'],
                'phone' => $validated['phone']  == " " ? $user->phone : $validated['phone'],
                'role' => $validated['role']  == " " ? $user->role : $validated['role'],
                'pin' => $validated['pin']  == " " ? $user->pin : $validated['pin'],
                'password' => $validated['password'] == " " ? $user->password : Hash::make($validated['password']),
            ]);
            
            return response()->json(['Message' => 'User updated successfully'],  200);

        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()],  500);
        }

     }

    // Delete user
    function destroy(User $user) {
        
        try {
            $user->delete();
        
            return response()->json(['Error' => 'User deleted successfully'], 200);
        
        } catch(Exception $e) {
        
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

     function registerPage() {
        return view('components.register-page');;
    }

    // MenuIndex:  load menu page
    function menuIndex() {
        return view('components.menu-component');
    }
}
