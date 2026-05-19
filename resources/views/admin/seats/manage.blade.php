@extends('layouts.admin')

@section('title', 'Quản lý Ghế - {{ $room->name }}')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Quản lý Ghế cho Phòng: {{ $room->name }}</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-2">Danh sách ghế hiện có</h2>
    <div class="grid grid-cols-8 gap-2 mb-6">
        @foreach($seats as $seat)
            <div class="p-2 border rounded text-center {{ $seat->type == 'vip' ? 'bg-yellow-100' : '' }}">
                {{ $seat->seat_code }}<br>
                <small>{{ ucfirst($seat->type) }}</small>
            </div>
        @endforeach
    </div>

    <h2 class="text-xl font-semibold mb-2">Tạo ghế tự động</h2>
    <form action="{{ route('admin.seats.generate', $room) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Khoảng hàng (ví dụ A-H)</label>
            <input type="text" name="rows" placeholder="A-H" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Số ghế mỗi hàng</label>
            <input type="number" name="seats_per_row" min="1" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Hàng VIP (có thể chọn nhiều, ví dụ E,F,G)</label>
            <input type="text" name="vip_rows" placeholder="E,F,G" class="w-full border rounded px-3 py-2">
            <small class="text-gray-600">Nhập các ký tự cách nhau bằng dấu phẩy.</small>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tạo ghế</button>
        <a href="{{ route('admin.rooms.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Quay lại</a>
    </form>
</div>
@endsection


