@extends('main')
@section('content')
    @if (!empty(session('msg')))
        <span style="color: pink;">{{ session('msg') }}</span>
    @endif
    <h1>{{ $title }}</h1>
    <a href="{{ route('companies.add') }}" style="margin-bottom:20px; display:inline-block;">Thêm công ty</a>
    <table border="1" width="50%">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Địa chỉ</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xoá</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($companies))
                @foreach ($companies as $key => $company)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <th>
                            <a href="{{ route('companies.edit', ['id'=>$company->id]) }}">Sửa</a>
                        </th>
                        <th>
                            <a href="{{ route('companies.delete', ['id'=>$company->id]) }}">Xoá</a>
                        </th>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Không có dữ liệu công ty</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
