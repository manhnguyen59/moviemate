@extends('layouts.admin')

@section('title', 'Thêm voucher')
@section('page-title', 'Thêm voucher')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Thêm voucher</h1>
        <p class="admin-page-subtitle">Tạo mã giảm giá cho khách nhập ở bước thanh toán.</p>
    </div>
    <a href="{{ route('admin.vouchers.index') }}" class="admin-btn-secondary">
        <i class="ph ph-arrow-left"></i>
        Quay lại
    </a>
</div>

@if ($errors->any())
    <div class="mb-5 max-w-4xl rounded-2xl border border-error/30 bg-error/10 text-error px-4 py-3 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.vouchers.store') }}" method="POST" class="admin-form-card max-w-4xl">
    @csrf
    @include('admin.vouchers.form', ['voucher' => null])
</form>
@endsection
