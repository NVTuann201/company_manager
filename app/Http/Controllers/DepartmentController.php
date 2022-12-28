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
        if ($request->search) {
            $data = Department::query()
                ->where('name', 'like', '%' . $request->search . '%')
                ->get();
        } else if ($request->start_date) {
            $data = Department::query()
                ->where('created_at', '>=', Carbon::createFromDate($request->start_date))
                ->where('created_at', '<=', Carbon::createFromDate($request->end_date))
                ->get();
        } else if ($request->company_id) {
            $data = Department::query()
                ->where('company_id', $request->company_id)
                ->get();
        } else {
            $data = Department::all();
        }
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
        $dataAdd = Department::create($request->only([
            'name',
            'company_id',
            'manager_id',
        ]));
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