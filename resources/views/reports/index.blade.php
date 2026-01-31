@extends('layouts.main')

@section('judul_halaman', 'Laporan & Riwayat')

@section('konten')

    <div class="mb-8">
        <form action="{{ route('reports.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-wrap items-end gap-4 mb-6">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-[#2251a5] hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-bold text-sm shadow transition">
                Tampilkan Data
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-green-600 text-white p-5 rounded-2xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-bold uppercase">Total Pemasukan</p>
                    <h3 class="text-3xl font-black mt-1">Rp {{ number_format($total_income, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white/20 p-3 rounded-full">💰</div>
            </div>
            <div class="bg-blue-600 text-white p-5 rounded-2xl shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-bold uppercase">Total Transaksi</p>
                    <h3 class="text-3xl font-black mt-1">{{ $total_transaksi }} <span class="text-lg font-medium">Sesi</span></h3>
                </div>
                <div class="bg-white/20 p-3 rounded-full">🧾</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Tanggal & Jam</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Nama Player</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Unit</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Durasi</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase">Total Bayar</th>
                    <th class="px-6 py-4 font-bold text-xs text-gray-500 uppercase text-center">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($transactions as $trans)
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-6 py-4 text-gray-600">
                            <div class="font-bold text-gray-800">{{ $trans->created_at->format('d M Y') }}</div>
                            <div class="text-xs">{{ $trans->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $trans->customer_name }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">
                                {{ $trans->console ? $trans->console->name : 'Unit Dihapus' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ floor($trans->duration_minutes / 60) }} Jam</td>
                        <td class="px-6 py-4 font-black text-green-600">Rp {{ number_format($trans->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.remove('hidden')" class="text-blue-600 hover:text-blue-800 font-bold text-xs underline">
                                Lihat Rincian
                            </button>
                        </td>
                    </tr>

                    <div id="detailModal-{{ $trans->id }}" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm p-4">
                        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-5 py-3 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="font-bold text-gray-800">Rincian Transaksi #{{ $trans->id }}</h3>
                                <button onclick="document.getElementById('detailModal-{{ $trans->id }}').classList.add('hidden')" class="text-gray-400 hover:text-red-500 text-xl font-bold">&times;</button>
                            </div>
                            <div class="p-5 overflow-y-auto max-h-[70vh]">
                                <div class="mb-4 text-sm text-gray-600 space-y-1">
                                    <p>Player: <span class="font-bold text-gray-900">{{ $trans->customer_name }}</span></p>
                                    <p>Waktu: {{ $trans->created_at->format('d M Y, H:i') }}</p>
                                    <p>Unit: {{ $trans->console ? $trans->console->name : '-' }} ({{ $trans->console ? $trans->console->type : '-' }})</p>
                                </div>

                                <hr class="border-dashed border-gray-300 my-3">

                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Sewa PS ({{ floor($trans->duration_minutes / 60) }} Jam)</span>
                                        <span class="font-bold text-gray-800">
                                            @php
                                                $fnbTotal = $trans->details->sum('subtotal');
                                                $rentalPrice = $trans->total_price - $fnbTotal;
                                            @endphp
                                            Rp {{ number_format($rentalPrice, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    @foreach($trans->details as $detail)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">
                                                {{ $detail->product ? $detail->product->name : 'Item Dihapus' }}
                                                <span class="text-xs text-gray-400">x{{ $detail->quantity }}</span>
                                            </span>
                                            <span class="font-bold text-gray-800">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <hr class="border-gray-800 my-4 border-t-2">

                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-600">TOTAL</span>
                                    <span class="font-black text-xl text-green-600">Rp {{ number_format($trans->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">
                            Tidak ada transaksi di tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
