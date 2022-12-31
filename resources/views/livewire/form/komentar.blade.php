<div>
    <button type="button" wire:click="openDiv" class="shadow-lg bg-green-600 text-white rounded py-1 px-3 font-medium">Komentar</button>
        @if ($showDiv)
        <div class="absolute shadow-xl bg-white rounded-lg lg:w-full w-[95%] px-10 py-5 bottom-0 lg:left-[400px] left-0 z-[55]">
            <div class="flex justify-between">
                <div><button type="button" wire:click="openDiv" class="font-medium"><i class="fa-solid fa-angles-left"></i></button></div>
                <h3 class="font-bold text-xl text-center">Komentar</h3>
                <div class="px-3"></div>
            </div>
            <br>
            
            <div class="overflow-scroll h-[200px]" id="hilanginscroll">
                @foreach($komen as $komentar)
                <div class="bg-gray-100 flex justify-between px-3 py-1 mb-1 rounded">
                    <p class="mr-5 text-left">
                        @php $waktu =  date("d-m-y H:i", strtotime($komentar->created_at)); @endphp
                        <span class="text-sm">[{{ $waktu }}]</span> <span class="font-bold @if($komentar->id_user == Auth::user()->id) text-red-600 @endif">
                        {{ $komentar->user->name }} : {{ $komentar->rating }}<br>
                        </span> {{ $komentar->isi_komentar }}
                    </p>
                    @if(Auth::user()->role == 1)
                        <button type="button" wire:click="delete({{ $komentar->id }})" class="text-red-500"><i class="fa-solid fa-trash-can"></i></button>
                    @else
                        @if($komentar->id_user == Auth::user()->id)
                        <button type="button" wire:click="delete({{ $komentar->id }})" class="text-red-500"><i class="fa-solid fa-trash-can"></i></button>
                        @endif
                    @endif
                </div>
                @endforeach
            </div>
        
            <form wire:submit.prevent="submit">
                <input type="hidden" wire:model="id_tempat" value="{{$id_tempat}}">
                <div class="flex flex-col justify-center gap-5 mt-5" x-data="{rating: 0, hovering: 0}">
                    <div class="flex flex-row justify-center gap-3">
                        <div 
                        class="flex flex-row justify-center w-10 h-2 rounded-md transition-all duration-200 cursor-pointer" 
                        x-bind:class="rating >= 1 ? 'bg-red-400' : 'bg-gray-300'" 
                        x-on:click="rating = 1, $wire.rating = 1" 
                        x-on:mouseover="hovering = 1"
                        x-on:mouseleave="hovering = 0">
                        <p class="text-2xl mt-4 select-none pointer-events-none" x-bind:class="rating == 1 || hovering == 1 ? '' : 'invisible' ">🤨</p>
                        </div>
                        <div 
                        class="flex flex-row justify-center w-10 h-2 rounded-md transition-all duration-200 cursor-pointer" 
                        x-bind:class="rating >= 2 ? 'bg-red-400' : 'bg-gray-300'" 
                        x-on:click="rating = 2, $wire.rating = 2" 
                        x-on:mouseover="hovering = 2"
                        x-on:mouseleave="hovering = 0">
                        <p class="text-2xl mt-4 select-none pointer-events-none" x-bind:class="rating == 2 || hovering == 2 ? '' : 'invisible' ">🙂</p>
                        </div>
                        <div 
                        class="flex flex-row justify-center w-10 h-2 rounded-md transition-all duration-200 cursor-pointer" 
                        x-bind:class="rating >= 3 ? 'bg-red-400' : 'bg-gray-300'" 
                        x-on:click="rating = 3, $wire.rating = 3" 
                        x-on:mouseover="hovering = 3"
                        x-on:mouseleave="hovering=0">
                        <p class="text-2xl mt-4 select-none pointer-events-none" x-bind:class="rating == 3 || hovering == 3 ? '' : 'invisible' ">😊</p>
                        </div>
                        <div 
                        class="flex flex-row justify-center w-10 h-2 rounded-md transition-all duration-200 cursor-pointer" 
                        x-bind:class="rating >= 4 ? 'bg-red-400' : 'bg-gray-300'" 
                        x-on:click="rating = 4, $wire.rating = 4" 
                        x-on:mouseover="hovering = 4"
                        x-on:mouseleave="hovering = 0">
                        <p class="text-2xl mt-4 select-none pointer-events-none" x-bind:class="rating == 4 || hovering == 4 ? '' : 'invisible' ">😚</p>
                        </div>
                        <div 
                        class="flex flex-row justify-center w-10 h-2 rounded-md transition-all duration-200 cursor-pointer" 
                        x-bind:class="rating >= 5 ? 'bg-red-400' : 'bg-gray-300'" 
                        x-on:click="rating = 5, $wire.rating = 5" 
                        x-on:mouseover="hovering = 5"
                        x-on:mouseleave="hovering = 0">
                        <p class="text-2xl mt-4 select-none pointer-events-none" x-bind:class="rating == 5 || hovering == 5 ? '' : 'invisible' ">😍</p>
                        </div>
                    </div>
                    <div class="flex flex-row justify-center gap-3 relative mt-8">
                        @error('rating') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="isi_komentar" class="block mb-2 text-sm font-medium text-gray-900">Komentar</label>
                    <textarea wire:model="isi_komentar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4"></textarea>
                    @error('isi_komentar') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kirim</button>
                </div>
            </form>
        </div>
        @endif
</div>
