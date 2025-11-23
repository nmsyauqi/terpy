<div class="p-6 font-mono">
    

    <div class="max-w-4xl mx-auto font-mc text-xl">
        
        @if (session()->has('message'))
            <div class="mb-4 bg-green-600 border-4 border-green-800 text-white p-2 shadow-lg">
                [!] {{ session('message') }}
            </div>
        @endif

        <div class="bg-gray-800 border-4 border-gray-600 p-6 mb-8 text-white shadow-xl relative">
            <div class="absolute top-2 left-2 w-2 h-2 bg-gray-400"></div>
            <div class="absolute top-2 right-2 w-2 h-2 bg-gray-400"></div>
            <div class="absolute bottom-2 left-2 w-2 h-2 bg-gray-400"></div>
            <div class="absolute bottom-2 right-2 w-2 h-2 bg-gray-400"></div>

            <h3 class="text-3xl text-yellow-400 mb-4 text-center drop-shadow-md">
                {{ $isEditing ? 'EDIT COORDINATE' : 'NEW WAYPOINT' }}
            </h3>
            
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                
                <div class="mb-4">
                    <label class="block text-gray-400 mb-1">Location Name</label>
                    <input type="text" wire:model="name" placeholder="e.g. Diamond Mine" 
                           class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-yellow-400 focus:ring-0">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-red-400 mb-1">X</label>
                        <input type="number" wire:model="cor_x" placeholder="0" 
                               class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-red-400 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-green-400 mb-1">Y</label>
                        <input type="number" wire:model="cor_y" placeholder="64" 
                               class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-green-400 focus:ring-0">
                    </div>
                    <div>
                        <label class="block text-blue-400 mb-1">Z</label>
                        <input type="number" wire:model="cor_z" placeholder="0" 
                               class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-blue-400 focus:ring-0">
                    </div>
                </div>
                @error('cor_x') <span class="text-red-500 text-sm">Coordinates required!</span> @enderror

                <div class="mb-4">
                    <label class="block text-gray-400 mb-1">Description (Optional)</label>
                    <textarea wire:model="desc" placeholder="Notes..." 
                              class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-yellow-400 focus:ring-0 h-20"></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gray-600 hover:bg-gray-500 text-white py-3 border-2 border-black mc-btn">
                        {{ $isEditing ? 'UPDATE WAYPOINT' : 'SAVE WAYPOINT' }}
                    </button>
                    
                    @if($isEditing)
                        <button type="button" wire:click="resetInput" class="bg-red-700 hover:bg-red-600 text-white px-6 border-2 border-black mc-btn">
                            CANCEL
                        </button>
                    @endif
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($derps as $derp)
                <div class="bg-gray-700 border-4 border-black p-4 relative group hover:bg-gray-600 transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="text-2xl text-yellow-400 drop-shadow-sm">{{ $derp->name }}</h4>
                        <div class="text-xs text-gray-400 bg-black bg-opacity-50 px-2 py-1 rounded">
                            X:<span class="text-red-400">{{ $derp->cor_x }}</span> 
                            Y:<span class="text-green-400">{{ $derp->cor_y }}</span> 
                            Z:<span class="text-blue-400">{{ $derp->cor_z }}</span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-900 bg-opacity-60 p-3 border-2 border-gray-500 text-gray-200 mb-4 text-sm">
                        {{ $derp->desc ?? 'No description.' }}
                    </div>
                    
                    <div class="flex justify-end gap-2">
                        <button wire:click="edit({{ $derp->id }})" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 border-2 border-black text-sm mc-btn">
                            EDIT
                        </button>
                        <button wire:click="delete({{ $derp->id }})" wire:confirm="Delete location?" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 border-2 border-black text-sm mc-btn">
                            DESTROY
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>