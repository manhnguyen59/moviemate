@extends('layouts.admin')

@section('title', 'Thêm phim mới')
@section('page-title', 'Thêm phim mới')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Thêm phim mới</h1>
        <p class="admin-page-subtitle">Tạo phim mới với thông tin phát hành, media và thể loại.</p>
    </div>
    <a href="{{ route('admin.movies.index') }}" class="admin-btn-secondary">
        <i class="ph ph-arrow-left"></i>
        Quay lại
    </a>
</div>

@if ($errors->any())
    <div class="mb-5 rounded-2xl border border-error/30 bg-error/10 text-error px-4 py-3 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('admin.movies.partials.form')
@endsection
