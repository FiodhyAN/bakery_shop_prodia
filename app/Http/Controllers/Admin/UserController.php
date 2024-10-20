<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users');
    }

    public function get(Request $request)
    {
        $user = User::where('user_role', '!=', 'customer')
            ->where('id', '!=', $request->user()->id)
            ->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('user_role', function ($user) {
                $badge = '<span class="badge bg-grd-';
                $badge .= $user->user_role == 'finance' ? 'info' : ($user->user_role == 'operation' ? 'warning' : 'success');
                $badge .= '">';
                $badge .= ucfirst($user->user_role);
                $badge .= '</span>';
                return $badge;
            })
            ->addColumn('action', function ($user) {
                $btn = '<div class="d-inline-flex align-items-center">';
                $btn .= '<a class="badge-icon position-relative p-3 rounded-circle text-white bg-grd-branding me-2 edit-btn" href="javascript:;" data-user_id="' . $user->id . '">
                  <i class="material-icons-outlined">edit</i>
                </a>';
                $btn .= '<a class="badge-icon position-relative p-3 rounded-circle text-white bg-secondary delete-btn" href="javascript:;" data-user_id="' . $user->id . '">
                  <i class="material-icons-outlined">delete</i>
                </a>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['action', 'user_role'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_role' => 'required|in:admin,finance,operation',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => $request->user_role,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => 'User created successfully!']);
    }

    public function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();
        return response()->json(['success' => 'User deleted successfully!']);
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'password' => 'nullable|min:8',
            'email' => 'email|unique:users,email,' . $request->id,
            'user_role' => 'in:admin,finance,operation',
        ]);

        $dataToUpdate = array_filter($request->only(['name', 'email', 'user_role', 'password']), function ($value) {
            return !is_null($value);
        });

        User::where('id', $request->id)->update($dataToUpdate);

        return response()->json(['success' => 'User updated successfully!']);
    }
}
