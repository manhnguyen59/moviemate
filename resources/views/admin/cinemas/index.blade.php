@extends('layouts.admin')

@section('title', 'Quản lý Rạp')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Quản lý Rạp</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <form method="GET" action="{{ route('admin.cinemas.index') }}" class="flex space-x-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tìm tên rạp..."
                   class="border rounded px-3 py-1">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Tìm</button>
        </form>
        <a href="{{ route('admin.cinemas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            Thêm mới
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Tên</th>
                <th class="border px-4 py-2">Địa chỉ</th>
                <th class="border px-4 py-2">Thành phố</th>
                <th class="border px-4 py-2">Số điện thoại</th>
                <th class="border px-4 py-2">Trạng thái</th>
                <th class="border px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cinemas as $cinema)
                <tr>
                    <td class="border px-4 py-2">{{ $cinema->id }}</td>
                    <td class="border px-4 py-2">{{ $cinema->name }}</td>
                    <td class="border px-4 py-2">{{ $cinema->address }}</td>
                    <td class="border px-4 py-2">{{ $cinema->city }}</td>
                    <td class="border px-4 py-2">{{ $cinema->phone ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $cinema->status }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('admin.cinemas.edit', $cinema) }}" class="text-yellow-600">Sửa</a>
                        <form action="{{ route('admin.cinemas.destroy', $cinema) }}" method="POST" class="inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa rạp này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Không có rạp nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $cinemas->links() }}
    </div>
</div>
@endsection


