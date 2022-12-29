<div>
    <button type="button" wire:click="openDiv" class="shadow-lg bg-green-600 text-white rounded py-1 px-3 font-medium">Komentar</button>
        @if ($showDiv)
        <div class="absolute shadow-xl bg-white rounded-lg w-full px-10 py-5 bottom-0 left-[400px]">
            <h3 class="font-bold text-xl text-center">Komentar</h3><br>
            
            <div class="overflow-scroll h-[200px]" id="hilanginscroll">
                @foreach($komen as $komentar)
                <div class="bg-gray-100 flex justify-between px-3 py-1 mb-1 rounded">
                    <p class="mr-5 text-left">
                        @php $waktu =  date("d-m-y H:i", strtotime($komentar->created_at)); @endphp
                        <span class="text-sm">[{{ $waktu }}]</span> <span class="font-bold">
                        {{ $komentar->user->name }} : <br>
                        </span> {{ $komentar->isi_komentar }}
                    </p>
                    <button type="button" wire:click="delete({{ $komentar->id }})" class="text-red-500"><i class="fa-solid fa-trash-can"></i></button>
                </div>
                @endforeach
            </div>
        
            <form wire:submit.prevent="submit">
                <input type="hidden" wire:model="id_tempat" value="{{$id_tempat}}">
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
