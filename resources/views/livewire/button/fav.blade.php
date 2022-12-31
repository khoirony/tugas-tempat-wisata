<div>
    <button wire:click="fav({{$id_tempat}})">
        @if(!$status)
        <i class="fa-regular fa-bookmark"></i>
        @else
        <i class="fa-solid fa-bookmark"></i>
        @endif
    </button>
</div>
