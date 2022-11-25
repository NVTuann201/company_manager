<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    private $company;
    public function __construct()
    {
        $this->company = new Company();
    }

    public function index()
    {
        $title = 'Danh sách công ty';
        $companies = $this->company->getAllCompanies();
        // dd(companies);

        return view('companies.lists', compact('title', 'companies'));
    }

    public function add()
    {
        $title = 'Thêm công ty mới';

        return view('companies.add', compact('title'));
    }

    public function store(Request $request)
    {
        $data = [
            $request->fullname,
            $request->address,
        ];
        // dd($data);
        $this->company->addCompany($data);

        return redirect()->route('companies.index')->with('msg', 'Thêm công ty mới thành công');
    }

    public function edit(Request $request, $id)
    {
        $title = 'Sửa thông tin công ty';
        $data = $this->company->getCompany($id);
        // dd($company);
        $company = $data[0];
        $request->session()->put('id', $id);

        return view('companies.edit', compact('title', 'company'));
    }

    public function update(Request $request)
    {
        $id = session('id');
        $data = [
            $request->fullname,
            $request->address,
        ];
        $this->company->updateCompany($data, $id);

        return back()->with('msg', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $this->company->deleteCompany($id);

        return redirect()->route('companies.index')->with('msg', 'Xoá thành công');
    }
}
