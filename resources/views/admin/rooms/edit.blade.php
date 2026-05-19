@extends('layouts.admin')

@section('title', 'Sửa Phòng Chiếu')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Sửa Phòng Chiếu: {{ $room->name }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Rạp *</label>
            <select name="cinema_id" required class="w-full border rounded px-3 py-2">
                @foreach($cinemas as $cinema)
                    <option value="{{ $cinema->id }}" {{ old('cinema_id', $room->cinema_id) == $cinema->id ? 'selected' : '' }}>
                        {{ $cinema->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Tên phòng *</label>
            <input type="text" name="name" value="{{ old('name', $room->name) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Loại phòng *</label>
            <input type="text" name="room_type" value="{{ old('room_type', $room->room_type) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Số ghế *</label>
            <input type="number" name="total_seats" value="{{ old('total_seats', $room->total_seats) }}" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Trạng thái *</label>
            <select name="status" required class="w-full border rounded px-3 py-2">
                <option value="active" {{ old('status', $room->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ old('status', $room->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Hủy</a>
        </div>
    </form>
</div>
@endsection


