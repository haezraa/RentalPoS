@extends('layouts.main')

@section('judul_halaman', 'Data Member')

@section('konten')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit">
            <h3 class="font-bold text-lg mb-4 text-gray-800">Daftar Member Baru</h3>
            <form action="{{ route('members.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Member</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="Contoh: Budi Speed">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nomor HP (WhatsApp)</label>
                    <input type="number" name="phone" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500" required placeholder="0812...">
                </div>
                <button type="submit" class="w-full bg-[#2251a5] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-lg">
                    Simpan Data
                </button>
            </form>
        </div>

        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">No. HP</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Bergabung</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $member->phone }}</td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ $member->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <form id="deleteMember-{{ $member->id }}" action="{{ route('members.destroy', $member->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="openConfirm('Yakin ingin menghapus member {{ $member->name }}?', 'deleteMember-{{ $member->id }}')"
                                        class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">Belum ada member yang terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
