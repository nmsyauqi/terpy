<div class="p-6 bg-gray-900 min-h-screen text-white"> <h2 class="text-3xl font-bold mb-6 text-green-400">🧭 Minecraft Waypoints</h2>

    <div class="bg-gray-800 p-6 rounded-lg border-2 border-gray-600 mb-8">
        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div class="col-span-4 md:col-span-1">
                <label class="block text-gray-400 text-xs">Nama Tempat</label>
                <input type="text" wire:model="name" class="w-full bg-gray-700 border-gray-600 rounded text-white">
            </div>

            <div>
                <label class="block text-red-400 text-xs font-bold">X</label>
                <input type="number" wire:model="x" class="w-full bg-gray-700 border-gray-600 rounded text-white">
            </div>
            <div>
                <label class="block text-green-400 text-xs font-bold">Y</label>
                <input type="number" wire:model="y" class="w-full bg-gray-700 border-gray-600 rounded text-white">
            </div>
            <div>
                <label class="block text-blue-400 text-xs font-bold">Z</label>
                <input type="number" wire:model="z" class="w-full bg-gray-700 border-gray-600 rounded text-white">
            </div>

            <div class="col-span-4">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded shadow-lg">
                    Simpan Koordinat
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($locations as $loc)
            <div class="bg-gray-800 border border-gray-600 p-4 rounded relative hover:bg-gray-750 transition">
                
                <h3 class="font-bold text-xl text-yellow-400 mb-2">{{ $loc->name }}</h3>
                
                <div class="font-mono bg-black bg-opacity-50 p-2 rounded text-center text-sm mb-3">
                    X: <span class="text-red-400">{{ $loc->coord_x }}</span> | 
                    Y: <span class="text-green-400">{{ $loc->coord_y }}</span> | 
                    Z: <span class="text-blue-400">{{ $loc->coord_z }}</span>
                </div>

                <p class="text-gray-400 text-xs mb-4">{{ $loc->description ?? 'Tidak ada catatan.' }}</p>

                <button wire:click="delete({{ $loc->id }})" class="text-red-500 text-xs hover:underline absolute bottom-4 right-4">
                    Hapus Lokasi
                </button>
            </div>
        @endforeach
    </div>
</div>