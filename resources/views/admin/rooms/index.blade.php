@extends('layouts.admin')

@section('title', 'Quản lý Phòng Chiếu')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Quản lý Phòng Chiếu</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <form method="GET" action="{{ route('admin.rooms.index') }}" class="flex space-x-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tìm tên phòng..."
                   class="border rounded px-3 py-1">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Tìm</button>
        </form>
        <a href="{{ route('admin.rooms.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            Thêm mới
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Rạp</th>
                <th class="border px-4 py-2">Tên phòng</th>
                <th class="border px-4 py-2">Loại</th>
                <th class="border px-4 py-2">Số ghế</th>
                <th class="border px-4 py-2">Trạng thái</th>
                <th class="border px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
                <tr>
                    <td class="border px-4 py-2">{{ $room->id }}</td>
                    <td class="border px-4 py-2">{{ $room->cinema->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $room->name }}</td>
                    <td class="border px-4 py-2">{{ $room->room_type }}</td>
                    <td class="border px-4 py-2">{{ $room->total_seats }}</td>
                    <td class="border px-4 py-2">{{ $room->status }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="text-yellow-600">Sửa</a>
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa phòng này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Xóa</button>
                        </form>
                        <a href="{{ route('admin.seats.manage', $room) }}" class="text-green-600">Quản lý ghế</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Không có phòng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>
</div>
@endsection


