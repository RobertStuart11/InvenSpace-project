<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — InvenSpace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
        {{-- ===== MODAL PEMBAYARAN ===== --}}
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
                {{-- Ringkasan Pesanan (Dinamis) --}}
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

                {{-- Pilihan Metode Pembayaran (Tetap) --}}
                <div class="mb-6">
                    <h4 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Pilih Metode Pembayaran</h4>
                    <div class="space-y-2">
                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300" checked>
                                <div>
                                    <div class="text-sm font-medium text-slate-800">Transfer Virtual Account</div>
                                    <div class="text-[10px] text-slate-500">BCA, Mandiri, BNI, BRI</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-blue-600 italic">VA</div>
                        </label>

                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <div>
                                    <div class="text-sm font-medium text-slate-800">E-Wallet</div>
                                    <div class="text-[10px] text-slate-500">GoPay, OVO, DANA, ShopeePay</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-rose-500 italic">e-Wallet</div>
                        </label>

                        <label class="flex items-center justify-between p-3 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-600 transition-colors has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/30">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <div>
                                    <div class="text-sm font-medium text-slate-800">QRIS</div>
                                    <div class="text-[10px] text-slate-500">Scan dengan semua aplikasi bank/e-wallet</div>
                                </div>
                            </div>
                            <div class="font-bold text-xs text-slate-800 italic">QR</div>
                        </label>
                    </div>
                </div>

                {{-- Tombol Bayar --}}
                <button type="button" class="w-full py-3.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/30 flex items-center justify-center gap-2">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    {{-- ===== SCRIPT UNTUK MODAL PEMBAYARAN ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const planBoxes = document.querySelectorAll('.plan-box');
            const modal = document.getElementById('paymentModal');
            const card = document.getElementById('paymentCard');
            const closeBtn = document.getElementById('closePaymentModal');

            // Data Harga (bisa disesuaikan nanti)
            const pricing = {
                'bulanan': { type: 'Bulanan', price: '150.000', ops: '5.000.000', total: '5.150.000' },
                'tahunan': { type: 'Tahunan', price: '1.650.000', ops: '58.500.000', total: '60.150.000' }
            };

            // Fungsi buka modal & ubah teks
            planBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    const planKey = box.getAttribute('data-plan');
                    const data = pricing[planKey];

                    // Ubah teks di dalam modal
                    document.getElementById('modalPlanType').innerText = `Paket ${data.type}`;
                    document.getElementById('modalPlanPrice').innerText = `Rp${data.price}`;
                    document.getElementById('modalSubtotal').innerText = `Rp${data.price}`;
                    document.getElementById('modalOpsType').innerText = data.type;
                    document.getElementById('modalOpsPrice').innerText = `Rp${data.ops}`;
                    document.getElementById('modalTotal').innerText = `Rp${data.total}`;

                    // Tampilkan Modal
                    modal.classList.remove('hidden');
                    setTimeout(() => card.classList.remove('scale-95'), 10);
                });
            });

            // Fungsi tutup modal
            const closeModal = () => {
                card.classList.add('scale-95');
                setTimeout(() => modal.classList.add('hidden'), 200);
            };

            closeBtn.addEventListener('click', closeModal);

            // Tutup jika klik di luar area card
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        });
    </script>
<body class="min-h-full bg-slate-50 text-slate-800 antialiased">

<div class="min-h-screen lg:flex">

    {{-- ===== SIDEBAR ===== --}}
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full bg-white border-r border-slate-200 flex flex-col transition-transform duration-200 lg:static lg:translate-x-0">

                <div class="h-16 flex items-center gap-2.5 px-5 border-b border-slate-100">
            <!-- Ganti kotak biru dengan logo PNG kamu -->
            <img src="{{ asset('images/logo.png - Copy.png') }}" alt="Logo" class="h-10 w-auto object-contain">

            <div>
                <div class="text-sm font-semibold text-slate-900">InvenSpace</div>
                <div class="text-[11px] text-slate-500 -mt-0.5">Inventaris Sekolah</div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto p-3 space-y-1 text-sm">
            @php
                $nav = [
                    ['route' => 'preview.dashboard',       'label' => 'Dashboard',    'icon' => 'dashboard'],
                    ['route' => 'preview.items',           'label' => 'Data Barang',  'icon' => 'box'],
                    ['route' => 'preview.loans',           'label' => 'Peminjaman',   'icon' => 'arrow-right'],
                    ['route' => 'preview.complaints',      'label' => 'Komplain',     'icon' => 'exclamation'],
                    ['route' => 'preview.stock-mutations', 'label' => 'Mutasi Stok',  'icon' => 'arrows'],
                    ['route' => 'preview.users',           'label' => 'Pengguna',     'icon' => 'users'],
                ];
                $current = request()->route()?->getName();
            @endphp

            @foreach($nav as $n)
                @php $active = $current === $n['route']; @endphp
                <a href="{{ route($n['route']) }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 transition
                          {{ $active ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100' }}">
                    <x-icon :name="$n['icon']" class="w-5 h-5 {{ $active ? 'text-indigo-600' : 'text-slate-400' }}" />
                    <span>{{ $n['label'] }}</span>
                </a>
            @endforeach
        </nav>

                    </nav>

        {{-- ===== CARD LANGGANAN SIDEBAR ===== --}}
        <div class="px-3 pb-3 mt-auto">
            <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-xl p-4 text-white shadow-lg relative overflow-hidden">
                {{-- Efek Background --}}
                <div class="absolute -top-4 -right-4 w-16 h-16 bg-white/10 rounded-full blur-md"></div>
                <div class="absolute -bottom-4 -left-4 w-12 h-12 bg-white/10 rounded-full blur-md"></div>

                {{-- Header --}}
                <div class="relative z-10 flex items-center gap-2 mb-3">
                    <div class="w-6 h-6 rounded-md bg-yellow-400/20 flex items-center justify-center border border-yellow-400/30">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-yellow-300"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                    </div>
                    <div class="text-[13px] font-bold tracking-wide">Coba Gratis 30 Hari</div>
                </div>

                                {{-- Pilihan Harga --}}
                <div class="relative z-10 space-y-2 mb-3">
                    {{-- Bulanan --}}
                    <div data-plan="bulanan" class="plan-box bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg p-2 flex justify-between items-center cursor-pointer transition-all">
                        <div>
                            <div class="text-[11px] font-semibold">Bulanan</div>
                            <div class="text-[9px] text-blue-200">Ops: Rp5.000.000</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-white">Rp150.000<span class="text-[9px] font-normal text-blue-200">/user</span></div>
                        </div>
                    </div>
                    {{-- Tahunan --}}
                    <div data-plan="tahunan" class="plan-box bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg p-2 flex justify-between items-center relative cursor-pointer transition-all">
                        <div class="absolute -top-2 -right-1 bg-yellow-400 text-yellow-900 text-[8px] font-bold px-1.5 py-0.5 rounded shadow-sm">
                            HEMAT
                        </div>
                        <div>
                            <div class="text-[11px] font-semibold">Tahunan</div>
                            <div class="text-[9px] text-blue-200">Ops: Rp58.500.000</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-white">Rp1.650.000<span class="text-[9px] font-normal text-blue-200">/user</span></div>
                        </div>
                    </div>
                </div>
                {{-- Hapus tombol "Pilih Paket" di bawah ini, karena kotaknya sudah bisa diklik --}}

                    {{-- Tombol CTA --}}
        <button id="openPaymentModal" class="relative z-10 w-full py-2 bg-white text-indigo-700 rounded-lg text-xs font-bold hover:bg-slate-50 transition-colors shadow-sm">
            Pilih Paket
        </button>
            </div>
        </div>
        {{-- ===== AKHIR CARD LANGGANAN ===== --}}

        <div class="p-3 border-t border-slate-100"></div>

        <div class="p-3 border-t border-slate-100">
            <div class="flex items-center gap-3 p-2 rounded-lg bg-slate-50">
                <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-sm">A</div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-slate-800 truncate">Administrator</div>
                    <div class="text-xs text-slate-500 truncate">admin@invenspace</div>
                </div>
                <a href="{{ route('preview.login') }}" title="Keluar" class="p-1.5 rounded-md hover:bg-white text-slate-400 hover:text-slate-600">
                    <x-icon name="logout" class="w-4 h-4" />
                </a>
            </div>
        </div>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-slate-900/40 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

    {{-- ===== MAIN ===== --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white/90 backdrop-blur border-b border-slate-200 flex items-center px-4 sm:px-6 gap-3 sticky top-0 z-20">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100" aria-label="Buka menu">
                <x-icon name="menu" class="w-5 h-5" />
            </button>
            <div class="flex-1 min-w-0">
                <h1 class="text-base sm:text-lg font-semibold text-slate-900 truncate">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-slate-500 truncate hidden sm:block">@yield('subtitle', 'Selamat datang di InvenSpace')</p>
            </div>
            <div class="flex items-center gap-2">
                @yield('actions')
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="px-6 py-4 text-xs text-slate-400 border-t border-slate-200 bg-white">
            &copy; {{ date('Y') }} InvenSpace · Laravel {{ app()->version() }}
        </footer>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('overlay').classList.toggle('hidden');
    }
</script>
@stack('scripts')
</body>
</html>
