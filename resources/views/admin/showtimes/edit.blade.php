@extends('layouts.admin')

@section('title', 'Chỉnh sửa suất chiếu - MovieMate Admin')
@section('page-title', 'Chỉnh sửa suất chiếu')

@section('content')
    <div class="app-card border app-border rounded-2xl overflow-hidden shadow-lg p-6">
        <form method="POST" action="{{ route('admin.showtimes.update', $showtime) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block font-medium mb-1">Phim <span class="text-red-600">*</span></label>
                    <select name="movie_id" class="app-input w-full">
                        <option value="">-- Chọn phim --</option>
                        @foreach($movies as $movie)
                            <option value="{{ $movie->id }}" {{ old('movie_id', $showtime->movie_id) == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('movie_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Rạp <span class="text-red-600">*</span></label>
                    <select name="cinema_id" id="cinema-select" class="app-input w-full">
                        <option value="">-- Chọn rạp --</option>
                        @foreach($cinemas as $cinema)
                            <option value="{{ $cinema->id }}" {{ old('cinema_id', $showtime->cinema_id) == $cinema->id ? 'selected' : '' }}>
                                {{ $cinema->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('cinema_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Phòng <span class="text-red-600">*</span></label>
                    <select name="room_id" id="room-select" class="app-input w-full">
                        <option value="">-- Chọn phòng --</option>
                        {{-- Options will be populated by JS based on selected cinema --}}
                    </select>
                    @error('room_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Ngày chiếu <span class="text-red-600">*</span></label>
                    <input type="date" name="show_date" value="{{ old('show_date', $showtime->show_date ? \Carbon\Carbon::parse($showtime->show_date)->format('Y-m-d') : '') }}" class="app-input w-full">
                    @error('show_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Giờ chiếu (HH:MM:SS) <span class="text-red-600">*</span></label>
                    <input type="time" name="show_time" value="{{ old('show_time', $showtime->show_time) }}" class="app-input w-full">
                    @error('show_time')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Giá thường (VND) <span class="text-red-600">*</span></label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $showtime->price) }}" class="app-input w-full">
                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Giá VIP (VND) (không bắt buộc)</label>
                    <input type="number" name="vip_price" step="0.01" value="{{ old('vip_price', $showtime->vip_price) }}" class="app-input w-full">
                    @error('vip_price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Trạng thái <span class="text-red-600">*</span></label>
                    <select name="status" class="app-input w-full">
                        <option value="active" {{ old('status', $showtime->status) == 'active' ? 'selected' : '' }}>Đang chiếu</option>
                        <option value="cancelled" {{ old('status', $showtime->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        <option value="finished" {{ old('status', $showtime->status) == 'finished' ? 'selected' : '' }}>Đã chiếu xong</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.showtimes.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 rounded-xl mr-3">Hủy</a>
                <button type="submit" class="px-5 py-2 bg-brand-start text-white rounded-xl">Cập nhật</button>
            </div>
        </form>
    </div>

    <script>
        const cinemaSelect = document.getElementById('cinema-select');
        const roomSelect   = document.getElementById('room-select');

        function loadRooms(cinemaId, selectedRoomId = null) {
            roomSelect.innerHTML = '<option value=\"\">-- Đang tải phòng... --</option>';
            if (!cinemaId) {
                roomSelect.innerHTML = '<option value=\"\">-- Chọn phòng --</option>';
                return;
            }

            fetch(`/api/cinemas/${cinemaId}/rooms`)
                .then(res => res.json())
                .then(data => {
                    let options = '<option value=\"\">-- Chọn phòng --</option>';
                    data.forEach(room => {
                        const selected = selectedRoomId == room.id ? 'selected' : '';
                        options += `<option value=\"${room.id}\" ${selected}>${room.name}</option>`;
                    });
                    roomSelect.innerHTML = options;
                })
                .catch(() => {
                    roomSelect.innerHTML = '<option value=\"\">-- Lỗi tải phòng --</option>';
                });
        }

        cinemaSelect.addEventListener('change', function () {
            loadRooms(this.value);
        });

        // Load rooms on page load with current values (for edit)
        @if(old('cinema_id', $showtime->cinema_id))
            loadRooms('{{ old('cinema_id', $showtime->cinema_id) }}', '{{ old('room_id', $showtime->room_id) }}');
        @endif
    </script>
@endsection
