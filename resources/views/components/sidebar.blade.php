    @if(Auth::user()->role == 1)
    <div class="bg-white shadow-xl flex flex-col justify-between rounded-lg py-7 px-7 fixed w-2/12 top-9 left-4 h-5/6 z-50">
        <div class="flex flex-col gap-5">
            <h1 class="font-bold text-xl text-center text-gray-700">Admin</h1> 
            <br>
    
            <a href="/admin" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Dashboard</a>

            <a href="/listuser" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Kelola User</a>
            
            <a href="/listtempat" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5" >Kelola Tempat</button>
            
            <a href="/tambahtempat" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Tambah Tempat</a>
    
            <a href="/caritempat" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Cari Tempat</a>
        </div>
        <a href="/logout" class="font-bold text-center">Logout</a>
    </div>
    @else
    <div class="bg-white shadow-xl flex flex-col justify-between rounded-lg py-7 px-7 fixed w-2/12 top-9 left-4 h-5/6 z-50">
        <div class="flex flex-col gap-5">
            <h1 class="font-bold text-xl text-center text-gray-700">{{Auth::user()->name}}</h1> 
            <br>
            <a href="/user" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Dashboard</a>

            <a href="/user/listtempat" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">List Tempat</a>
            
            <a href="/user/profile" class="text-white text-center bg-red-700 shadow-xl p-3 w-full rounded-lg font-bold mr-5">Profile</a>
        </div>
        <a href="/logout" class="font-bold text-center">Logout</a>
    </div>
    @endif