<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\RoleUserController;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->search) {
            $data = User::query()
                ->where('name', 'like', '%' . $request->search . '%')
                ->get();
        } else if ($request->department_id) {
            $data = User::query()
                ->where('department_id', $request->department_id)
                ->get();
        } else if ($request->role_id) {
            $data = User::query()
                ->where('role_id', $request->role_id)
                ->get();
        } else {
            $data = User::all();
        }
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'department_id' => 'required',
        ]);
        $dataAdd = User::create($request->only([
            'name',
            'email',
            'phone_number',
            'password',
            'department_id',
        ]));

        if ($request->role_id) {
            $roleUserRequest = new Request();
            $roleUserRequest->merge([
                'user_id' => $dataAdd->id,
                'role_id' => $request->role_id,
            ]);
            $roleUser = RoleUserController::store($roleUserRequest);
        }
        if (empty($data)) {
            return response()->json([
                'message' => 'fail'
            ], 404);
        } else {
            return response()->json([
                'message' => 'success'
            ]);
        }
        // return response()->json($dataAdd);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required',
            'department_id' => 'required',
        ]);
        $data = User::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'department_id' => $request->department_id,
            ]);

        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = User::query()
            ->where('id', $id)
            ->delete();
        $roleUser = RoleUserController::destroy($id);
        return response()->json($data);
    }
    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = User::query()
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();
        if (!empty($data)) {
            $message = "success";
        } else {
            $message = "fail";
        }
        return response()->json([
            'data' => $data,
            'message' => $message,
        ]);
    }
}