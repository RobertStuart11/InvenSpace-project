<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — InvenSpace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased font-sans">

<div class="min-h-screen flex">

    {{-- ================= PANEL KIRI (Biru) ================= --}}
    <div class="hidden lg:flex lg:w-[45%] bg-[#2563EB] relative overflow-hidden flex-col justify-between p-12 lg:p-16">

        {{-- Efek Background Lingkaran --}}
        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-white/5 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[25rem] h-[25rem] bg-white/5 rounded-full blur-2xl -ml-20 -mb-20 pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

        {{-- Logo --}}
       <div class="relative z-10 flex items-center gap-3 -ml-4">
            <img src="{{ asset('images/logo.png.png') }}" alt="InvenSpace Logo" class="h-20 w-auto object-contain drop-shadow-sm">
        </div>

        {{-- Konten Tengah --}}
        <div class="relative z-10 max-w-lg space-y-10 mt-12">
            <div>
                <h1 class="text-4xl lg:text-[2.75rem] font-bold leading-[1.15] text-white">Kelola inventaris lebih cerdas, bukan lebih rumit.</h1>
                <p class="mt-5 text-blue-100 text-sm leading-relaxed max-w-md">Pantau barang, lacak pergerakan barang, dan ambil keputusan berbasis data — semuanya dari satu dashboard yang rapi dan mudah digunakan.</p>
            </div>

            {{-- Card Fitur --}}
            <div class="space-y-4">
                {{-- Fitur 1 --}}
                <div class="bg-white/10 border border-white/20 rounded-2xl p-4 flex items-center gap-4 backdrop-blur-sm">
                    <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-sm text-white">Total Barang Tercatat</span>
                            <span class="text-[11px] font-medium bg-white/20 px-2.5 py-1 rounded-md text-white">1,284</span>
                        </div>
                        <p class="text-xs text-blue-100 mt-1">Real-time dari seluruh gudang.</p>
                    </div>
                </div>
                {{-- Fitur 2 --}}
                <div class="bg-white/10 border border-white/20 rounded-2xl p-4 flex items-center gap-4 backdrop-blur-sm">
                    <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-sm text-white">Peringatan Stok Rendah</span>
                            <span class="text-[11px] font-medium bg-white/20 px-2.5 py-1 rounded-md text-white">7 item</span>
                        </div>
                        <p class="text-xs text-blue-100 mt-1">Notifikasi otomatis saat menipis.</p>
                    </div>
                </div>
                {{-- Fitur 3 --}}
                <div class="bg-white/10 border border-white/20 rounded-2xl p-4 flex items-center gap-4 backdrop-blur-sm">
                    <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-sm text-white">Laporan & Analitik</span>
                            <span class="text-[11px] font-medium bg-white/20 px-2.5 py-1 rounded-md text-white">AKIF</span>
                        </div>
                        <p class="text-xs text-blue-100 mt-1">Visualisasi data inventaris.</p>
                    </div>
                </div>
            </div>
        </div>
            {{-- ===== MODAL PROMO LANGGANAN ===== --}}
    <div id="promoModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 relative transform transition-transform duration-300 scale-95" id="promoCard">

            {{-- Tombol Close (X) --}}
            <button id="closeModal" class="absolute top-4 right-4 p-1.5 text-slate-400 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-full transition-colors">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            {{-- Header --}}
            <div class="text-center mb-5">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 text-blue-600 mb-3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Coba Gratis 30 Hari</h3>
                <p class="text-xs text-slate-500 mt-1">Tingkatkan efisiensi inventaris Anda.</p>
            </div>

                        {{-- Pilihan Harga --}}
            <div class="grid grid-cols-2 gap-3 mb-5">
                {{-- Bulanan --}}
                <div data-plan="bulanan" class="plan-trigger border border-slate-200 rounded-2xl p-4 text-center hover:border-blue-500 hover:shadow-md transition-all cursor-pointer">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Bulanan</div>
                    <div class="text-lg font-bold text-slate-900">Rp150Rb</div>
                    <div class="text-[10px] text-slate-500">/pengguna</div>
                    <div class="mt-2 pt-2 border-t border-slate-100 text-[10px] text-slate-600">Ops: Rp5.000.000</div>
                </div>
                {{-- Tahunan --}}
                <div data-plan="tahunan" class="plan-trigger border-2 border-blue-500 rounded-2xl p-4 text-center relative bg-blue-50/30 hover:shadow-md transition-all cursor-pointer">
                    <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-blue-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full">HEMAT</div>
                    <div class="text-[11px] font-bold text-blue-500 uppercase tracking-wider mb-1">Tahunan</div>
                    <div class="text-lg font-bold text-slate-900">Rp1.65Jt</div>
                    <div class="text-[10px] text-slate-500">/pengguna</div>
                    <div class="mt-2 pt-2 border-t border-blue-100 text-[10px] text-slate-600">Ops: Rp58.500.000</div>
                </div>
            </div>

            {{-- CTA Button --}}
            <button id="ctaBtn" class="w-full py-3 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30">
                Mulai Sekarang
            </button>
            <p class="text-center text-[10px] text-slate-400 mt-3">Tanpa kartu kredit. Batalkan kapan saja.</p>
        </div>
    </div>

        {{-- ===== MODAL PEMBAYARAN (BARU DI LOGIN) ===== --}}
    <div id="paymentModal" class="fixed inset-0 z-[60] hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full relative transform transition-transform duration-300 scale-95 overflow-hidden" id="paymentCard">

            {{-- Header Modal --}}
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-900">Selesaikan Pembayaran</h3>
                <button id="closePaymentModal" class="p-1.5 text-slate-400 hover:text-slate-700 bg-white hover:bg-slate-100 rounded-full border border-slate-200 transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="p-6">
                {{-- Ringkasan Pesanan --}}
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 mb-6">
                    <div class="flex justify-between items-center mb-3 pb-3 border-b border-slate-200">
                        <div>
                            <div id="modalPlanType" class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider mb-0.5">Paket Tahunan</div>
                            <div class="text-sm font-semibold text-slate-800">InvenSpace Premium</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-bold text-slate-900"><span id="modalPlanPrice">Rp1.650.000</span> <span class="text-xs font-normal text-slate-500">/user</span></div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs text-slate-600">
                            <span>Langganan (1 Pengguna)</span>
                            <span id="modalSubtotal">Rp1.650.000</span>
                        </div>
                        <div class="flex justify-between text-xs text-slate-600">
                            <span>Biaya Operasional (<span id="modalOpsType">Tahunan</span>)</span>
                            <span id="modalOpsPrice">Rp58.500.000</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-indigo-700 pt-2 border-t border-slate-200 mt-2">
                            <span>Total Tagihan</span>
                            <span id="modalTotal">Rp60.150.000</span>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="mb-6">
                    <h4 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Pilih Metode Pembayaran</h4>
                    <div class="space-y-2">
                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300" checked>
                                <div>
                                    <div class="text-sm font-medium text-slate-800">Transfer Virtual Account</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-blue-600 italic">VA</div>
                        </label>
                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <div>
                                    <div class="text-sm font-medium text-slate-800">E-Wallet</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-rose-500 italic">e-Wallet</div>
                        </label>
                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <div>
                                    <div class="text-sm font-medium text-slate-800">QRIS</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-slate-800 italic">QR</div>
                        </label>
                    </div>
                </div>

                <button type="button" class="w-full py-3.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/30">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    {{-- ===== SCRIPT UNTUK KEDUA MODAL ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- 1. Logika Pop-up Promo Login ---
            const promoModal = document.getElementById('promoModal');
            const promoCard = document.getElementById('promoCard');
            const closePromoBtn = document.getElementById('closeModal');
            const ctaBtn = document.getElementById('ctaBtn');

            const hasSeenPromo = localStorage.getItem('invenspace_promo_seen');

            if (!hasSeenPromo && promoModal) {
                setTimeout(() => {
                    promoModal.classList.remove('hidden');
                    setTimeout(() => promoCard.classList.remove('scale-95'), 10);
                    localStorage.setItem('invenspace_promo_seen', 'true');
                }, 1000);
            }

            const closePromo = () => {
                promoCard.classList.add('scale-95');
                setTimeout(() => promoModal.classList.add('hidden'), 200);
            };

            if (closePromoBtn) closePromoBtn.addEventListener('click', closePromo);
            if (ctaBtn) ctaBtn.addEventListener('click', closePromo);

            if (promoModal) {
                promoModal.addEventListener('click', (e) => {
                    if (e.target === promoModal) closePromo();
                });
            }

            // --- 2. Logika Modal Pembayaran ---
            const planTriggers = document.querySelectorAll('.plan-trigger');
            const paymentModal = document.getElementById('paymentModal');
            const paymentCard = document.getElementById('paymentCard');
            const closePaymentBtn = document.getElementById('closePaymentModal');

            const pricing = {
                'bulanan': { type: 'Bulanan', price: '150.000', ops: '5.000.000', total: '5.150.000' },
                'tahunan': { type: 'Tahunan', price: '1.650.000', ops: '58.500.000', total: '60.150.000' }
            };

            planTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const planKey = trigger.getAttribute('data-plan');
                    const data = pricing[planKey];

                    // Update isi modal pembayaran
                    document.getElementById('modalPlanType').innerText = `Paket ${data.type}`;
                    document.getElementById('modalPlanPrice').innerText = `Rp${data.price}`;
                    document.getElementById('modalSubtotal').innerText = `Rp${data.price}`;
                    document.getElementById('modalOpsType').innerText = data.type;
                    document.getElementById('modalOpsPrice').innerText = `Rp${data.ops}`;
                    document.getElementById('modalTotal').innerText = `Rp${data.total}`;

                    // Tutup promo, buka pembayaran
                    closePromo();
                    setTimeout(() => {
                        paymentModal.classList.remove('hidden');
                        setTimeout(() => paymentCard.classList.remove('scale-95'), 10);
                    }, 250); // delay dikit biar animasi promo selesai
                });
            });

            const closePayment = () => {
                paymentCard.classList.add('scale-95');
                setTimeout(() => paymentModal.classList.add('hidden'), 200);
            };

            if (closePaymentBtn) closePaymentBtn.addEventListener('click', closePayment);

            if (paymentModal) {
                paymentModal.addEventListener('click', (e) => {
                    if (e.target === paymentModal) closePayment();
                });
            }
        });
    </script>

        {{-- Footer Kiri --}}
        <div class="relative z-10 text-xs text-blue-200 mt-12">
            &copy; 2027 InvenSpace · Sistem Manajemen Barang
        </div>
    </div>

    {{-- ================= PANEL KANAN (Form Login) ================= --}}
    <div class="flex-1 flex items-center justify-center p-4 sm:p-8">

        {{-- Card Putih --}}
        <div class="w-full max-w-[440px] bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 sm:p-10 border border-slate-100">

            {{-- Ikon User --}}
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-6">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-[#2563EB]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
            </div>

            <h2 class="text-2xl font-bold text-slate-900">Selamat datang kembali</h2>
            <p class="text-sm text-slate-500 mt-2 mb-6">Masuk ke akun Anda atau daftar untuk mulai mengelola inventaris.</p>

            {{-- Tab Masuk / Daftar --}}
            <div class="bg-slate-50 p-1 rounded-xl flex mb-6">
                <button type="button" class="flex-1 py-2.5 text-sm font-medium bg-white shadow-sm text-[#2563EB] rounded-lg flex items-center justify-center gap-2 border border-slate-200/50">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                    Masuk
                </button>
                <button type="button" class="flex-1 py-2.5 text-sm font-medium text-slate-500 hover:text-slate-700 flex items-center justify-center gap-2 transition-colors">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
                    Daftar
                </button>
            </div>

            {{-- Form --}}
            <form class="space-y-4" onsubmit="event.preventDefault();">
                <div>
                    <label class="text-[13px] font-medium text-slate-700">Email<span class="text-rose-500">*</span></label>
                    <input type="email" value="admin@inventaris.com" class="mt-1.5 w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] outline-none transition-all placeholder:text-slate-400" placeholder="admin@inventaris.com">
                </div>
                <div>
                    <label class="text-[13px] font-medium text-slate-700">Kata sandi<span class="text-rose-500">*</span></label>
                    <input type="password" value="password" class="mt-1.5 w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] outline-none transition-all placeholder:text-slate-400" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-[13px] py-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded border-slate-300 text-[#2563EB] focus:ring-[#2563EB] cursor-pointer">
                        <span class="text-slate-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-[#2563EB] font-medium hover:underline">Lupa kata sandi?</a>
                </div>

                <button type="button" class="w-full py-3.5 rounded-xl bg-[#2563EB] text-white text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-500/25 mt-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                    Masuk ke halaman
                </button>
            </form>

            <div class="my-6 flex items-center gap-4">
                <div class="flex-1 h-px bg-slate-100"></div>
                <span class="text-[11px] font-medium text-slate-400 uppercase tracking-wider">atau masuk dengan</span>
                <div class="flex-1 h-px bg-slate-100"></div>
            </div>

            {{-- Tombol Google (Microsoft dihilangkan sesuai request) --}}
            <div>
                <button type="button" class="w-full py-2.5 rounded-xl border border-slate-200 flex items-center justify-center gap-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
            </div>

            <p class="text-center text-[13px] text-slate-500 mt-8">
                Belum punya akun? <a href="#" class="text-[#2563EB] font-medium hover:underline">Daftar sekarang</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
