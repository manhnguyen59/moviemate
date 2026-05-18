@extends('layouts.admin')

@section('title', 'Quản lý Người dùng - MovieMate Admin')
@section('page-title', 'Quản lý người dùng')

@section('content')
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-lg">
        
        <!-- Header & Filters -->
        <div class="p-6 border-b border-dark-border">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-6">
                
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ph ph-magnifying-glass text-text-sub text-lg"></i>
                    </div>
                    <input type="text" class="w-full pl-11 pr-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors text-sm" placeholder="Tìm tên, email, SĐT...">
                </div>

                <div class="flex gap-2 w-full md:w-auto">
                    <button class="px-4 py-2.5 bg-dark-main border border-dark-border text-white rounded-xl hover:border-brand-start transition-colors text-sm font-medium flex items-center gap-2">
                        <i class="ph ph-export"></i> Xuất Excel
                    </button>
                    <button class="px-4 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors flex items-center gap-2">
                        <i class="ph-bold ph-plus"></i> Thêm người dùng
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap gap-4">
                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Phân quyền</option>
                    <option>Khách hàng (User)</option>
                    <option>Nhân viên (Staff)</option>
                    <option>Quản trị viên (Admin)</option>
                </select>

                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Trạng thái</option>
                    <option>Đang hoạt động</option>
                    <option>Bị khóa (Banned)</option>
                </select>

                <select class="px-4 py-2 bg-dark-main border border-dark-border rounded-lg text-white text-sm focus:outline-none focus:border-brand-start min-w-[150px]">
                    <option value="">Hạng thẻ</option>
                    <option>Thành viên (Bronze)</option>
                    <option>Bạc (Silver)</option>
                    <option>Vàng (Gold)</option>
                    <option>Kim cương (Diamond)</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto hide-scrollbar">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-dark-main/50 text-xs uppercase tracking-wider text-text-sub border-b border-dark-border">
                        <th class="p-4 font-medium w-16">Avatar</th>
                        <th class="p-4 font-medium">Người dùng</th>
                        <th class="p-4 font-medium">Vai trò</th>
                        <th class="p-4 font-medium text-center">Hạng thẻ / Điểm</th>
                        <th class="p-4 font-medium text-center">Tổng chi tiêu</th>
                        <th class="p-4 font-medium text-center">Trạng thái</th>
                        <th class="p-4 font-medium text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border text-sm">
                    
                    @php
                        $users = [
                            ['name' => 'Nguyễn Mạnh', 'email' => 'manh@example.com', 'role' => 'User', 'rank' => 'Vàng', 'points' => 1250, 'spent' => '2.500.000đ', 'status' => 'active'],
                            ['name' => 'Admin System', 'email' => 'admin@moviemate.vn', 'role' => 'Admin', 'rank' => '-', 'points' => '-', 'spent' => '-', 'status' => 'active'],
                            ['name' => 'Trần B', 'email' => 'tranb@example.com', 'role' => 'User', 'rank' => 'Bạc', 'points' => 450, 'spent' => '900.000đ', 'status' => 'active'],
                            ['name' => 'Nhân viên 01', 'email' => 'staff01@moviemate.vn', 'role' => 'Staff', 'rank' => '-', 'points' => '-', 'spent' => '-', 'status' => 'active'],
                            ['name' => 'Lê C (Spammer)', 'email' => 'lec@spam.com', 'role' => 'User', 'rank' => 'Thành viên', 'points' => 0, 'spent' => '0đ', 'status' => 'banned'],
                        ];
                    @endphp

                    @foreach($users as $key => $user)
                    <tr class="hover:bg-dark-main/30 transition-colors">
                        <td class="p-4">
                            <div class="w-10 h-10 rounded-full overflow-hidden border border-dark-border bg-dark-main">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=252A36&color=fff" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-white block">{{ $user['name'] }}</span>
                            <span class="text-xs text-text-sub">{{ $user['email'] }}</span>
                        </td>
                        <td class="p-4">
                            @if($user['role'] == 'Admin')
                                <span class="text-brand-start font-bold">{{ $user['role'] }}</span>
                            @elseif($user['role'] == 'Staff')
                                <span class="text-ai-start font-bold">{{ $user['role'] }}</span>
                            @else
                                <span class="text-text-main">{{ $user['role'] }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            @if($user['rank'] != '-')
                                <span class="font-medium text-white block">{{ $user['rank'] }}</span>
                                <span class="text-xs text-brand-start font-bold">{{ $user['points'] }} pt</span>
                            @else
                                <span class="text-text-sub">-</span>
                            @endif
                        </td>
                        <td class="p-4 text-center font-medium text-white">
                            {{ $user['spent'] }}
                        </td>
                        <td class="p-4 text-center">
                            @if($user['status'] == 'active')
                                <span class="inline-flex px-2 py-1 bg-success/10 text-success rounded text-[10px] font-bold uppercase tracking-wider">Hoạt động</span>
                            @else
                                <span class="inline-flex px-2 py-1 bg-error/10 text-error rounded text-[10px] font-bold uppercase tracking-wider">Bị khóa</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.users.show', $key+1) }}" class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:border-brand-start flex items-center justify-center transition-colors" title="Xem chi tiết">
                                    <i class="ph-bold ph-eye"></i>
                                </a>
                                <button class="w-8 h-8 rounded-lg border border-dark-border text-text-sub hover:text-white hover:bg-error hover:border-error flex items-center justify-center transition-colors" title="Khóa tài khoản">
                                    <i class="ph-bold ph-lock-key"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-dark-border bg-dark-main/50 flex items-center justify-between text-sm">
            <span class="text-text-sub">Hiển thị 1 - 5 trong tổng số 8,592 người dùng</span>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors disabled:opacity-50"><i class="ph ph-caret-left"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand-start text-white font-medium">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors">...</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-dark-border text-text-sub hover:text-white transition-colors disabled:opacity-50"><i class="ph ph-caret-right"></i></button>
            </div>
        </div>

    </div>
@endsection
