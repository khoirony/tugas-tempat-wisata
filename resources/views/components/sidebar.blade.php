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
    <div class="bg-white shadow-xl flex flex-col justify-between rounded-lg py-7 px-7 absolute lg:bottom-20 bottom-10 left-4 lg:w-2/12 w-11/12 lg:h-5/6 h-1/12 z-50">
        <div class="flex lg:flex-col flex-row lg:justify-center justify-between lg:gap-5 gap-2">
            <h1 class="font-bold text-xl text-center text-gray-700 lg:block hidden">{{Auth::user()->name}}</h1> 
            <br>
            <a href="/user" class="text-white text-center bg-red-700 shadow-xl p-3 lg:w-full w-2/4 px-5 rounded-lg font-bold">
                <span class="lg:hidden block"><i class="fa-solid fa-house"></i></span> 
                <span class="lg:block hidden">Dashboard</span> 
            </a>

            <a href="/user/listtempat" class="text-white text-center bg-red-700 shadow-xl p-3 lg:w-full w-2/4 px-5 rounded-lg font-bold">
                <span class="lg:hidden block"><i class="fa-solid fa-location-dot"></i></span> 
                <span class="lg:block hidden">List Tempat</span>
            </a>
            
            <a href="/user/caritempat" class="text-white text-center bg-red-700 shadow-xl p-3 lg:w-full w-2/4 px-5 rounded-lg font-bold">
                <span class="lg:hidden block"><i class="fa-solid fa-magnifying-glass"></i></span> 
                <span class="lg:block hidden">Cari Tempat</span>
            </a>
            
            <a href="/user/profile" class="text-white text-center bg-red-700 shadow-xl p-3 lg:w-full w-2/4 px-5 rounded-lg font-bold">
                <span class="lg:hidden block"><i class="fa-solid fa-user"></i></span> 
                <span class="lg:block hidden">Profile</span>
            </a>
        </div>
        <a href="/logout" class="font-bold text-center lg:block hidden">Logout</a>
    </div>
    @endif