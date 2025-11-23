<div class="p-6 font-mono"> <style>
        @import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');
        .font-mc { font-family: 'VT323', monospace; }
        .mc-btn {
            box-shadow: inset -4px -4px 0px 0px rgba(0,0,0,0.5), inset 4px 4px 0px 0px rgba(255,255,255,0.5);
        }
        .mc-btn:active {
            box-shadow: inset 4px 4px 0px 0px rgba(0,0,0,0.5), inset -4px -4px 0px 0px rgba(255,255,255,0.5);
        }
    </style>

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
                    <input type="text" wire:model="title" placeholder="e.g. Diamond Mine" 
                           class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-yellow-400 focus:ring-0">
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-400 mb-1">Coordinates / Notes</label>
                    <textarea wire:model="content" placeholder="X: -200, Y: 64, Z: 300" 
                              class="w-full bg-black bg-opacity-50 border-2 border-gray-500 text-white px-3 py-2 focus:border-yellow-400 focus:ring-0 h-24"></textarea>
                    @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gray-600 hover:bg-gray-500 text-white py-3 border-2 border-black mc-btn">
                        {{ $isEditing ? 'UPDATE' : 'SAVE' }}
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
                        <h4 class="text-2xl text-yellow-400 drop-shadow-sm">{{ $derp->title }}</h4>
                        <span class="text-gray-400 text-sm">{{ $derp->created_at->format('d M H:i') }}</span>
                    </div>
                    
                    <div class="bg-gray-900 bg-opacity-60 p-3 border-2 border-gray-500 text-gray-200 mb-4">
                        {{ $derp->content }}
                    </div>
                    
                    <div class="flex justify-end gap-2">
                        <button wire:click="edit({{ $derp->id }})" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 border-2 border-black text-sm mc-btn">
                            EDIT
                        </button>
                        <button wire:click="delete({{ $derp->id }})" wire:confirm="Destroy this waypoint?" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 border-2 border-black text-sm mc-btn">
                            DESTROY
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if($derps->isEmpty())
            <div class="text-center text-gray-500 mt-10">
                <p class="text-2xl">Inventory Empty...</p>
            </div>
        @endif
    </div>
</div>