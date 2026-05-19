@extends('layouts.admin')

@section('title', 'Thêm Rạp')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Thêm Rạp</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cinemas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Tên *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Địa chỉ *</label>
            <input type="text" name="address" value="{{ old('address') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Thành phố *</label>
            <input type="text" name="city" value="{{ old('city') }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Hình ảnh</label>
            <input type="file" name="image" accept="image/*" class="w-full">
        </div>

        <div>
            <label class="block font-medium">Mô tả</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Trạng thái *</label>
            <select name="status" required class="w-full border rounded px-3 py-2">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Lưu</button>
            <a href="{{ route('admin.cinemas.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Hủy</a>
        </div>
    </form>
</div>
@endsection


