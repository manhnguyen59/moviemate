@extends('layouts.admin')
@section('title', 'Quản lý người dùng - MovieMate Admin')
@section('page-title', 'Quản lý người dùng')
@section('content')
<div class="admin-table-card">
    <form method="GET" class="p-5 border-b app-border space-y-3">
        <div class="flex flex-col md:flex-row gap-3"><input name="search" value="{{ request('search') }}" class="admin-input flex-1" placeholder="Tìm tên, email, SĐT..."><button class="admin-btn-primary"><i class="ph ph-magnifying-glass"></i> Tìm kiếm</button><a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">Đặt lại</a></div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <select name="role_id" class="admin-input"><option value="">Mọi vai trò</option>@foreach($roles as $role)<option value="{{ $role->id }}" @selected((string)request('role_id') === (string)$role->id)>{{ $role->name }}</option>@endforeach</select>
            <select name="status" class="admin-input"><option value="">Mọi trạng thái</option><option value="active" @selected(request('status')==='active')>Hoạt động</option><option value="banned" @selected(request('status')==='banned')>Bị khóa</option></select>
            <select name="tier" class="admin-input"><option value="">Mọi hạng</option><option value="member" @selected(request('tier')==='member')>Thành viên</option><option value="silver" @selected(request('tier')==='silver')>Bạc</option><option value="gold" @selected(request('tier')==='gold')>Vàng</option><option value="diamond" @selected(request('tier')==='diamond')>Kim cương</option></select>
        </div>
    </form>
    <div class="overflow-x-auto"><table class="admin-table"><thead><tr><th>Người dùng</th><th>Vai trò</th><th class="text-center">Hạng / Điểm</th><th class="text-right">Tổng chi tiêu</th><th class="text-center">Trạng thái</th><th></th></tr></thead><tbody>
    @forelse($users as $user)<tr>
        <td><div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full app-secondary flex items-center justify-center overflow-hidden">@if($user->avatar)<img src="{{ \App\Models\Movie::imageUrl($user->avatar) }}" class="w-full h-full object-cover">@else<i class="ph-bold ph-user"></i>@endif</div><div><strong class="block">{{ $user->name }}</strong><span class="text-xs app-muted">{{ $user->email }}</span></div></div></td>
        <td class="font-semibold {{ $user->role?->name === 'Admin' ? 'text-brand-start' : ($user->role?->name === 'Staff' ? 'text-ai-start' : '') }}">{{ $user->role?->name ?? '—' }}</td>
        <td class="text-center"><span class="block font-semibold">{{ $user->membership_tier }}</span><span class="text-xs text-brand-start font-bold">{{ number_format($user->loyalty_points,0,',','.') }} điểm</span></td>
        <td class="text-right font-bold">{{ number_format($user->total_spent ?? 0,0,',','.') }}đ</td>
        <td class="text-center"><span class="admin-badge {{ $user->status === 'active' ? 'text-success bg-success/10' : 'text-error bg-error/10' }}">{{ $user->status === 'active' ? 'Hoạt động' : 'Bị khóa' }}</span></td>
        <td class="text-right"><a href="{{ route('admin.users.show', $user) }}" class="admin-btn-info admin-action-btn" title="Xem chi tiết" aria-label="Xem chi tiết" data-tooltip="Xem chi tiết"><i class="ph-bold ph-eye"></i></a></td>
    </tr>@empty<tr><td colspan="6" class="admin-empty">Không có người dùng phù hợp.</td></tr>@endforelse
    </tbody></table></div>
    @if($users->hasPages())<div class="p-4 border-t app-border">{{ $users->links() }}</div>@endif
</div>
@endsection
