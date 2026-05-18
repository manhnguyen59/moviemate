@extends('layouts.user')

@section('title', 'Thanh Toán - MovieMate')

@section('content')
    <div class="min-h-screen py-8 app-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center sm:justify-start gap-2 sm:gap-4 text-xs sm:text-sm">
                    <div class="flex items-center gap-2 text-brand-start font-medium">
                        <div class="w-7 h-7 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs"><i class="ph-bold ph-check"></i></div>
                        <span class="hidden sm:inline">Chọn phim & Suất</span>
                    </div>
                    <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
                    <div class="flex items-center gap-2 text-brand-start font-medium">
                        <div class="w-7 h-7 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs"><i class="ph-bold ph-check"></i></div>
                        <span class="hidden sm:inline">Chọn ghế</span>
                    </div>
                    <div class="h-px w-8 sm:w-12 bg-brand-start"></div>
                    <div class="flex items-center gap-2 text-brand-start font-medium">
                        <div class="w-7 h-7 rounded-full bg-brand-start text-white flex items-center justify-center font-bold text-xs">3</div>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                <!-- Left: Forms -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Thông tin người đặt -->
                    <div class="app-card border app-border rounded-2xl p-6">
                        <h2 class="text-lg font-bold app-text mb-5 flex items-center gap-2 border-l-4 border-brand-start pl-3">
                            <i class="ph-fill ph-user-circle"></i> Thông tin người nhận vé
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium app-muted mb-1.5">Họ và tên</label>
                                <input type="text" id="name" value="Nguyễn Mạnh" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium app-muted mb-1.5">Số điện thoại</label>
                                <input type="tel" id="phone" value="0987654321" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium app-muted mb-1.5">Email nhận vé</label>
                                <input type="email" id="email" value="manh@example.com" class="app-input w-full px-4 py-2.5 border app-border rounded-xl focus:outline-none focus:border-brand-start transition-colors text-sm">
                                <p class="text-xs text-brand-start mt-2 flex items-center gap-1"><i class="ph-fill ph-info"></i> Vé điện tử (QR Code) sẽ được gửi về email này.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="app-card border app-border rounded-2xl p-6">
                        <h2 class="text-lg font-bold app-text mb-5 flex items-center gap-2 border-l-4 border-brand-start pl-3">
                            <i class="ph-fill ph-credit-card"></i> Phương thức thanh toán
                        </h2>

                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 app-input border border-brand-start rounded-xl cursor-pointer hover:border-brand-start transition-colors">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="vnpay" checked class="text-brand-start focus:ring-brand-start w-4 h-4">
                                    <div>
                                        <p class="app-text font-medium text-sm mb-0.5">Thanh toán VNPay</p>
                                        <p class="text-xs app-muted">Ví điện tử VNPay, thẻ ATM, Visa/Mastercard</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-blue-400 bg-blue-400/10 border border-blue-400/30 px-2 py-1 rounded">VNPAY</span>
                            </label>

                            <label class="flex items-center justify-between p-4 app-input border app-border rounded-xl cursor-pointer hover:border-pink-400/50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="momo" class="text-brand-start focus:ring-brand-start w-4 h-4">
                                    <div>
                                        <p class="app-text font-medium text-sm mb-0.5">Ví MoMo</p>
                                        <p class="text-xs app-muted">Thanh toán qua ứng dụng MoMo</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-pink-400 bg-pink-400/10 border border-pink-400/30 px-2 py-1 rounded">MOMO</span>
                            </label>

                            <label class="flex items-center justify-between p-4 app-input border app-border rounded-xl cursor-pointer hover:border-brand-start/50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment_method" value="counter" class="text-brand-start focus:ring-brand-start w-4 h-4">
                                    <div>
                                        <p class="app-text font-medium text-sm mb-0.5">Thanh toán tại quầy</p>
                                        <p class="text-xs app-muted">Giữ chỗ trong 15 phút. Thanh toán tại rạp trước 30 phút.</p>
                                    </div>
                                </div>
                                <i class="ph ph-storefront text-2xl app-muted"></i>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Right: Summary -->
                <div class="lg:col-span-1">
                    <div class="app-card border app-border rounded-2xl overflow-hidden sticky top-24 shadow-xl shadow-black/10">
                        <div class="p-5 app-secondary border-b app-border">
                            <h3 class="text-base font-bold app-text text-center">Tóm tắt vé</h3>
                        </div>

                        <div class="p-5">
                            <div class="flex gap-4 mb-5">
                                <div class="w-16 flex-shrink-0 rounded-lg overflow-hidden" style="padding-top: 0; height: 88px;">
                                    <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" alt="Poster" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-bold app-text text-base leading-tight mb-1">Thanh Gươm Diệt Quỷ</h4>
                                    <p class="text-xs app-muted mb-2">2D Phụ Đề Việt</p>
                                    <span class="text-xs border border-brand-start text-brand-start px-2 py-0.5 rounded font-bold">T13</span>
                                </div>
                            </div>

                            <ul class="space-y-3 mb-5 text-sm border-t app-border pt-4">
                                <li class="flex justify-between"><span class="app-muted">Rạp</span><span class="app-text font-medium text-right text-xs">MovieMate Cầu Giấy</span></li>
                                <li class="flex justify-between"><span class="app-muted">Suất chiếu</span><span class="app-text font-medium text-right text-xs">09:30 - 19/05</span></li>
                                <li class="flex justify-between"><span class="app-muted">Phòng chiếu</span><span class="app-text font-medium text-right text-xs">Phòng 3</span></li>
                                <li class="flex justify-between"><span class="app-muted">Ghế (2x VIP)</span><span class="text-brand-start font-bold text-right">F7, F8</span></li>
                            </ul>

                            <div class="space-y-2.5 mb-4 pt-4 border-t app-border text-sm">
                                <div class="flex justify-between"><span class="app-muted">Tạm tính</span><span class="app-text font-medium">160.000đ</span></div>
                                <div class="flex justify-between"><span class="app-muted">Giảm giá</span><span class="text-success font-medium">0đ</span></div>
                            </div>

                            <div class="flex justify-between items-center mb-5 pt-4 border-t app-border">
                                <span class="app-muted text-sm">Tổng:</span>
                                <span class="text-2xl font-bold text-brand-start">160.000đ</span>
                            </div>
                            <p class="text-xs app-muted text-right -mt-3 mb-4">Đã bao gồm VAT</p>

                            <a href="{{ route('user.bookings.success') }}" class="block w-full py-3.5 bg-gradient-to-r from-brand-start to-brand-end text-white text-center rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-brand-start/30 transition-all transform hover:-translate-y-0.5">
                                Xác nhận đặt vé
                            </a>
                            <p class="text-center text-xs app-muted mt-3">
                                Bằng việc đặt vé, bạn đồng ý với <a href="#" class="text-brand-start hover:underline">Điều khoản</a>.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection