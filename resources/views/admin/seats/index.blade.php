@extends('layouts.admin')

@section('title', 'Quản lý Ghế')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Quản lý Ghế</h1>

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

    <div class="flex justify-between mb-4">
        <form method="GET" action="{{ route('admin.seats.index') }}" class="flex space-x-2">
            <select name="room_id" class="border rounded px-3 py-1">
                <option value="">Tất cả phòng</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->name }} ({{ $room->cinema->name ?? '' }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Lọc</button>
        </form>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Phòng</th>
                <th class="border px-4 py-2">Mã ghế</th>
                <th class="border px-4 py-2">Hàng</th>
                <th class="border px-4 py-2">Số</th>
                <th class="border px-4 py-2">Loại</th>
                <th class="border px-4 py-2">Trạng thái</th>
                <th class="border px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($seats as $seat)
                <tr>
                    <td class="border px-4 py-2">{{ $seat->id }}</td>
                    <td class="border px-4 py-2">{{ $seat->room->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $seat->seat_code }}</td>
                    <td class="border px-4 py-2">{{ $seat->row }}</td>
                    <td class="border px-4 py-2">{{ $seat->number }}</td>
                    <td class="border px-4 py-2">{{ $seat->type }}</td>
                    <td class="border px-4 py-2">{{ $seat->status }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('admin.seats.update', $seat) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <select name="type" class="border rounded px-1 py-0">
                                <option value="normal" {{ $seat->type == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="vip" {{ $seat->type == 'vip' ? 'selected' : '' }}>VIP</option>
                                <option value="couple" {{ $seat->type == 'couple' ? 'selected' : '' }}>Couple</option>
                            </select>
                            <select name="status" class="border rounded px-1 py-0">
                                <option value="active" {{ $seat->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="maintenance" {{ $seat->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            <button type="submit" class="text-blue-600">Lưu</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="border px-4 py-2 text-center">Không có ghế nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $seats->links() }}
    </div>
</div>
@endsection


