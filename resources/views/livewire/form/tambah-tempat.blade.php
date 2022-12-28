    <div class="absolute bg-white rounded-lg shadow-xl p-10 z-50 left-72 bottom-20 w-80">
        <form wire:submit.prevent="submit">
            <div class="flex mb-3">
                <div class="mr-3">
                    <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900">Latitude</label>
                    <input type="text" id="latitude" wire:model="latitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @error('latitude') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900">Longitude</label>
                    <input type="text" id="longitude" wire:model="longitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @error('longitude') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Nama Tempat</label>
                <input type="text" wire:model="nama_tempat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('nama_tempat') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                <textarea type="text" wire:model="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4" required></textarea>
                @error('alamat') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan</button>
        </form>
    </div>
