<div>
    <h3 class="mb-4 text-lg font-semibold">Create Employee</h3>
    @if(session()->has('msg'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"> 
            <span class="block sm:inline">{{ session('msg') }}</span>
        </div>
    @endif
    <form wire:submit="save" class="grid grid-cols-2 gap-2">
        <div class="mb-4">
            <div class="relative z-0 w-full group">
                <input type="name" wire:model="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Name
                </label>
            </div>
            @error('name')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div>
        <div>
            <div class="relative z-0 w-full group">
                <input type="email" wire:model="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Email address
                </label>
            </div>
            @error('email')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div> 
        <div>
            <div class="relative z-0 w-full group">
                <input type="cp" wire:model="cp" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="cp" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Cellphone number
                </label>
            </div>
            @error('cp')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div>  
        <div class="mb-2">
            <div class="relative z-0 w-full group">
                <input type="date" wire:model="dob" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="bod" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Birthday
                </label>
            </div>
            @error('dob')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div> 
        <div class="row-span-2">
            <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                Create
            </button>
        </div>
    </form> 
</div>