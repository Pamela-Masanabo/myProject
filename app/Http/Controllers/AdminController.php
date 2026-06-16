<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function index()
    {
        $staffCount = User::count();
        return view('admin.dashboard', compact('staffCount'));  
    }

 public function create()
 {
    return view('admin.register-staff');
 }

   public function store(Request $request)
    {
        $validated = $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required|unique:users',
            'username' => 'required|unique:users',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'department' => 'nullable',
            'specialty' => 'nullable',
            'password' => 'required|min:6',

        ]);
        // Set specialty to null for roles that don't require it
        if(
            $request->role === 'ADMIN' ||
            $request->role === 'RECEPTIONIST' ||
            $request->role === 'DOCTOR'
            ){
                $validated['specialty'] = null;
            }
            
        // Set department based on role
        $department = match ($request->role) {

    'ADMIN' => 'ADMINISTRATION',
    'RECEPTIONIST' => 'RECEPTION',
    'STAFF_NURSE' => 'SCREENING',
    'PROFESSIONAL_NURSE' => 'CONSULTATION',
    'DOCTOR' => 'CONSULTATION',
};

        $validated['password'] = bcrypt($validated['password']);
        $validated['department'] = $department;

        User::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Staff account created successfully.');
    }

    

}
