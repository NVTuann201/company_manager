<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Department::query()->get();
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|unique',
        //     'company_id' => 'required',
        // ]);
        $dataAdd = Department::create($request->all());
        return response()->json($dataAdd);
    }
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|unique',
        //     'company_id' => 'required',
        // ]);
        $data = Department::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'company_id' => $request->company_id,
                'manager_id' => $request->manager_id,
            ]);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $result = Department::query()
            ->where('id', $id)
            ->delete();

        return response()->json($result);
    }
}