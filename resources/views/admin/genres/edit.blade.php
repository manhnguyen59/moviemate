@extends('layouts.admin')

@section('title', 'Chỉnh sửa thể loại - MovieMate Admin')
@section('page-title', 'Chỉnh sửa thể loại')

@section('content')
    <form action="#" class="max-w-3xl">
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 md:p-8 space-y-6">
            
            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Tên thể loại</label>
                <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="Hành động">
            </div>

            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Slug</label>
                <input type="text" class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors" value="hanh-dong">
            </div>

            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Mô tả (Không bắt buộc)</label>
                <textarea rows="4" class="w-full px-4 py-3 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors">Phim có nhiều cảnh chiến đấu, rượt đuổi, đánh võ...</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-text-sub mb-2">Trạng thái</label>
                <select class="w-full px-4 py-2.5 bg-dark-main border border-dark-border rounded-xl text-white focus:outline-none focus:border-brand-start transition-colors appearance-none">
                    <option value="active" selected>Hoạt động</option>
                    <option value="inactive">Tạm ẩn</option>
                </select>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-brand-start text-white font-bold rounded-xl hover:bg-brand-end transition-colors">
                    Cập nhật thể loại
                </button>
                <a href="{{ route('admin.genres.index') }}" class="px-6 py-2.5 bg-dark-main border border-dark-border text-white font-medium rounded-xl hover:bg-dark-border transition-colors">
                    Hủy
                </a>
            </div>

        </div>
    </form>
@endsection
