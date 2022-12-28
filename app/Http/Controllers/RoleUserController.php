<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleUser;

class RoleUserController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->id) {
            $data = RoleUser::query()
                ->where('user_id', $request->id)
                ->get();
        } else {
            $data = RoleUser::all();
        }
        return response()->json($data);
    }
    public static function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $dataAdd = RoleUser::query()->insert([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);
        return response()->json($dataAdd);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $data = RoleUser::query()
            ->where('id', $id)
            ->update([
                'user_id' => $request->user_id,
                'role_id' => $request->role_id,
            ]);
        return response()->json($data);
    }
    public static function destroy($id)
    {
        $data = RoleUser::query()
            ->where('id', $id)
            ->delete();
        return response()->json($data);
    }
}