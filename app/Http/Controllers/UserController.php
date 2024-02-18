<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate user inputs before storing data
            $incomingFields = $request->validate([
                "name" => ["required", "regex:/^[a-zA-Z\s'-]+$/", "min:3", Rule::unique("users", "name")],
                "email" => ["required", "email", 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', Rule::unique("users", "email")],
                "password" => ["required", "min:8", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/"]
            ]);

            // Hashing user password
            $incomingFields["password"] = bcrypt($incomingFields["password"]);

            // Create new user
            User::create($incomingFields);

            // Redirect to Login page
            return response()->json(['message' => 'Registration successful'], 200);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => 'Error processing the request'], 500);
        };
    }

    // public function login(Request $request)
    // {
    //     $incomingFields = $request->validate([
    //         "loginmail" => "required",
    //         "loginpassword" => "required"
    //     ]);

    //     if (auth()->attempt(["email" => $incomingFields["loginmail"], "password" => $incomingFields["loginpassword"]])) {
    //         $request->session()->regenerate();
    //     };
    //     return redirect("/");
    // }

    public function login(Request $request)
    {
        try {
            $incomingFields = $request->validate([
                "loginmail" => "required|email",
                "loginpassword" => "required"
            ]);

            if (auth()->attempt(["email" => $incomingFields["loginmail"], "password" => $incomingFields["loginpassword"]])) {
                $request->session()->regenerate();

                return response()->json(['message' => 'Login successful'], 200); // If you're using API, return JSON response
            }

            throw ValidationException::withMessages([
                'loginmail' => ['Invalid email or password'], // Customize the error message as needed
            ]);

            // If you're not using API, you can redirect back with errors
            // return redirect()->back()->withErrors(['loginmail' => 'Invalid email or password'])->withInput();
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => 'Error processing the request'], 500);
        }
    }



    public function logout()
    {
        auth()->logout();
        return redirect("/login");
    }
}
