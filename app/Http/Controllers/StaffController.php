<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of staff.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by first name, last name or employee ID
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%");

            });

        }

        // Filter by role
        if ($request->filled('role')) {

            $query->where('role', $request->role);

        }

        $staff = $query->orderBy('first_name')->paginate(10);

        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created staff member.
     */
    public function store(Request $request)
    {
        $request->validate([

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:users,employee_id',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required',
            'department' => 'required',
            'specialty' => 'nullable|string|max:255',
            'password' => 'required|min:8|confirmed',

        ]);

        User::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'employee_id' => $request->employee_id,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
            'specialty' => $request->specialty,
            'password' => Hash::make($request->password),
            'is_active' => true,

        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff member registered successfully.');
    }

    /**
     * Show the form for editing a staff member.
     */
    public function edit(User $user)
    {
        return view('admin.staff.edit', compact('user'));
    }

    /**
     * Update a staff member.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required',
            'department' => 'required',
            'specialty' => 'nullable|string|max:255',

        ]);

        $user->update([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
            'specialty' => $request->specialty,

        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    /**
     * Activate or deactivate a staff member.
     */
    public function toggleStatus(User $user)
    {
        $user->update([

            'is_active' => !$user->is_active

        ]);

        return back()->with(
            'success',
            'Staff status updated successfully.'
        );
    }
}