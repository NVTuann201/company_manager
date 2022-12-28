<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $data = Role::query()
                ->where('name', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $data = Role::all();
        }
        return response()->json($data);
    }
    public function store(Request $request)
    {
        // $dataAdd = Role::create($request->only(['name']));
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        $dataAdd = Role::query()->insert([
            'name' => $request->name,
        ]);
        return response()->json($dataAdd);
    }
    public function update(Request $request, $id)
    {
        $data = Role::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = Role::query()
            ->where('id', $id)
            ->delete();
        return response()->json($data);
    }
}
