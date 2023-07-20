<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestrictedController extends Controller
{
    public static function restrictAccess(Request $request)
    {
        // Access restriction logic
        if ($request->user()) {
            // Check the role of the user
            if ($request->user()->role === 'Reporter') {
                // Redirect the user or show an error message
                return redirect()->back()->with('message', 'Access denied. You do not have permission to view this page.');
            }
        } else {
            // Redirect the user to the login page or show an error message
            return redirect()->route('login')->with('message', 'Please login to access this page.');
        }
    }
}

