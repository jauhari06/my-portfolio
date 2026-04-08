<div x-data="" x-init="initCard()" class="bento-card col-span-1 md:row-span-2 bg-retro-surface border border-retro-border p-6 flex flex-col justify-between hover:border-white transition-colors relative">
    
    <div class="absolute top-2 right-2 text-xs border border-gray-600 px-2 bg-black">PLAYER 1</div>

    <div class="flex items-center gap-4 mb-6 mt-4">
        {{-- Avatar Kotak (Bisa pakai foto profil Anda yang diberi filter grayscale) --}}
        <div class="w-16 h-16 border-2 border-white p-1 bg-black">
            <img src="https://api.dicebear.com/9.x/pixel-art/svg?backgroundType=gradientLinear,solid" alt="Avatar" class="w-full h-full object-cover">
        </div>
        <div>
            <h3 class="text-xl font-bold uppercase">Backend Mage</h3>
            <p class="text-xs text-gray-500">Level 21</p>
        </div>
    </div>

    <div class="space-y-4 flex-grow">
        {{-- HP / MP Bar --}}
        <div>
            <div class="flex justify-between text-xs mb-1">
                <span>HP (Coffee)</span>
                <span>85/100</span>
            </div>
            <div class="w-full h-3 border border-gray-600 bg-black">
                <div class="h-full bg-red-600 w-[85%]"></div>
            </div>
        </div>
        
        <div>
            <div class="flex justify-between text-xs mb-1">
                <span>MP (Focus)</span>
                <span>60/100</span>
            </div>
            <div class="w-full h-3 border border-gray-600 bg-black">
                <div class="h-full bg-blue-600 w-[60%]"></div>
            </div>
        </div>
    </div>

    <div class="mt-6 border-t border-dashed border-gray-700 pt-4">
        <p class="text-xs text-gray-400 mb-2">EQUIPPED ITEMS:</p>
        <div class="flex gap-2">
            <span class="px-2 py-1 text-xs border border-gray-700 bg-gray-900">Laravel Sword</span>
            <span class="px-2 py-1 text-xs border border-gray-700 bg-gray-900">SQL Shield</span>
        </div>
    </div>
</div>