<div class="flex justify-center items-center h-screen">
    <div class="w-2xl min-w-72 bg-gray-50 rounded-md shadow-md p-4">
        <div class="mb-4">
            <h3 class="text-2xl font-bold text-center">Login</h3>
        </div>
        <form wire:submit="proccessLogin" class=""> 
            @error('invalid')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert"> 
                <span class="block sm:inline">{{ $message }}</span>
            </div> 
            @enderror 
            <div class="mb-4">
                <div class="relative z-0 w-full group">
                    <input type="email" wire:model="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email
                    </label>
                </div>
                @error('email')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
            </div>  
            <div class="mb-4">
                <div class="relative z-0 w-full group">
                    <input type="password" wire:model="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Password <span class="text-xs">(yyyy-mm-dd)</span>
                    </label>
                </div>
                @error('email')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
            </div>    
            <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                Login
            </button> 
        </form>
    </div>
</div>
