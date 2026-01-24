<div onclick="addToCart('{{ $item->id }}', '{{ addslashes($item->name) }}', {{ $item->price }}, {{ $item->stock }})"
     class="menu-item-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer hover:shadow-md hover:border-blue-400 transition group relative h-full flex flex-col justify-between">

    <div class="h-28 bg-gray-100 overflow-hidden relative">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300 text-3xl">🍽️</div>
        @endif
        <span class="absolute top-2 right-2 bg-black/60 text-white text-[10px] px-2 py-0.5 rounded-full backdrop-blur-sm font-bold shadow-sm border border-white/20">
            {{ $item->stock }}
        </span>
    </div>

    <div class="p-3">
        <h4 class="font-bold text-gray-800 text-sm truncate leading-tight mb-1">{{ $item->name }}</h4>
        <p class="text-xs text-blue-600 font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
    </div>

    </div>
