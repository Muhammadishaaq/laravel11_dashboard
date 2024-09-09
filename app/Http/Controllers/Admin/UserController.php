<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('partials.user.index', compact('data'));
    }

    public function create()
    {
        return view('partials.user.create');
    }

    public function store(Request $request)
    {
        $validatorData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validatorData->passes()) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['success' => true, 'message' => 'Record stored successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Validation failed.']);
        }
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('partials.user.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }



}
