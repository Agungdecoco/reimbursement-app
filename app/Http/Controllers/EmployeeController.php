<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where('jabatan', '!=', 'DIREKTUR')->get();
        return view('director.employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('director.addEmployee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = Hash::make($request->password);
        User::create([
            'nip' => $request->nip,
            'nama' => $request->employee_name,
            'jabatan' => $request->role,
            'password' => $password,
        ]);

        return redirect()->route('employees.index')->with('success', 'Pengajuan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attributes = User::all()->where('nip', $id);
        return view('director.editEmployee', compact('attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'employee_name' => 'required|string|max:50',
            'role' => 'required|string|in:DIREKTUR,FINANCE,STAFF',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::where('nip', $id)->first();
    
        if (!$user) {
            return redirect()->route('employees.index')->with('error', 'User not found.');
        }

        $user->nama = $request->input('employee_name');
        $user->jabatan = $request->input('role');
        if ($request->has('password') && !empty($request->input('password'))) {
            $password = Hash::make($request->input('password'));
            $user->password = $password;
        }
 
        $user->save();
    
        return redirect()->route('employees.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('nip', $id)->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}
