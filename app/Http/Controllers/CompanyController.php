<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search){
            $data = Company::query()
                ->where('name', 'like', '%'.$request->search.'%')
                ->get();
        }
        else if ($request->start_date){
            $data = Company::query()
                ->where('created_at', '>=', Carbon::createFromDate($request->start_date))
                ->where('created_at', '<=', Carbon::createFromDate($request->end_date))
                ->get();
        }else if ($request->name){
            $data = Company::query()
                ->where('name', $request->name)
                ->get();
        }else if ($request->address){
            $data = Company::query()
                ->where('address', $request->address)
                ->get();
        }else{
            $data = Company::all();
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $dataAdd = Company::create($request->all());
        return response()->json($dataAdd);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     $request->fullname,
        //     $request->address,
        // ]);
        $dataAdd = Company::create($request->only('name', 'address'));

        return response()->json($dataAdd);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $company = Company::findOrFail($id);
        // dd($request->address);
        $data = Company::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'address' => $request->address,
            ]);
        // dd($data);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Company::query()
            ->where('id', $id)
            ->delete();

        return response()->json($result);
    }
}
