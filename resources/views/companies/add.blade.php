@extends('main')
@section('content')
    <h1>{{ $title }}</h1>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div>
            <label for="">Tên công ty</label>
            <input type="text" name="fullname" placeholder="Nhập tên công ty ...">
        </div>
        <div>
            <label for="">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ ...">
        </div>

        <button type="submit">Thêm mới</button>
    </form>
@endsection
