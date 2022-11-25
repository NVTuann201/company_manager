@extends('main')
@section('content')
    @if (!empty(session('msg')))
    <span style="color: pink;">{{ session('msg') }}</span>
    @endif
    <h1>{{ $title }}</h1>
    <form action="{{ route('companies.update') }}" method="POST">
        @csrf
        <div>
            <label for="">Tên công ty</label>
            <input type="text" name="fullname" placeholder="Nhập tên công ty ..." value="{{ $company->name }}">
        </div>
        <div>
            <label for="">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ ..." value="{{ $company->address }}">
        </div>

        <button type="submit">Cập nhật</button>
    </form>
@endsection
