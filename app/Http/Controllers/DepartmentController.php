<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    private $department;
    public function __construct()
    {
        $this->department = new Department();
    }

    public function index()
    {
        $title = 'Danh sách phòng ban';
        $departments = $this->department->getAllDepartments();
        // dd($departments);

        return view('departments.lists', compact('title', 'departments'));
    }

    public function add()
    {
        $title = 'Thêm phòng ban mới';

        return view('departments.add', compact('title'));
    }

    public function store(Request $request)
    {
        $data = [
            $request->fullname,
            $request->company_id,
        ];
        // dd($data);
        $this->department->addDepartment($data);

        return redirect()->route('departments.index')->with('msg', 'Thêm phòng ban mới thành công');
    }

    public function edit(Request $request, $id)
    {
        $title = 'Sửa thông tin phòng ban';
        $data = $this->department->getDepartment($id);
        // dd($department);
        $department = $data[0];
        $request->session()->put('id', $id);

        return view('departments.edit', compact('title', 'department'));
    }

    public function update(Request $request)
    {
        $id = session('id');
        $data = [
            $request->fullname,
            $request->company_id,
        ];
        // dd($data);
        $this->department->updateDepartment($data, $id);

        return redirect()->route('departments.index')->with('msg', 'Sửa thông tin phòng ban thành công');
    }

    public function destroy($id)
    {
        $this->department->deleteDepartment($id);

        return redirect()->route('departments.index')->with('msg', 'Xóa phòng ban thành công');
    }

}
