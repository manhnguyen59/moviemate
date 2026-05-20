@extends('layouts.admin')

@section('title', 'Sửa Rạp')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Sửa Rạp: {{ $cinema->name }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cinemas.update', $cinema) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Tên *</label>
            <input type="text" name="name" value="{{ old('name', $cinema->name) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Địa chỉ *</label>
            <input type="text" name="address" value="{{ old('address', $cinema->address) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Thành phố *</label>
            <input type="text" name="city" value="{{ old('city', $cinema->city) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Vĩ độ</label>
                <input type="number" name="latitude" value="{{ old('latitude', $cinema->latitude) }}" step="0.0000001" min="-90" max="90" placeholder="21.027763" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Kinh độ</label>
                <input type="number" name="longitude" value="{{ old('longitude', $cinema->longitude) }}" step="0.0000001" min="-180" max="180" placeholder="105.834160" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone', $cinema->phone) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Hình ảnh hiện tại</label>
            @if($cinema->image)
                <img src="{{ asset('storage/' . $cinema->image) }}" alt="Cinema Image" class="h-32 mb-2">
            @else
                <p>Chưa có hình ảnh.</p>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full">
        </div>

        <div>
            <label class="block font-medium">Mô tả</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $cinema->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Trạng thái *</label>
            <select name="status" required class="w-full border rounded px-3 py-2">
                <option value="active" {{ old('status', $cinema->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ old('status', $cinema->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
            <a href="{{ route('admin.cinemas.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Hủy</a>
        </div>
    </form>
</div>
@endsection


