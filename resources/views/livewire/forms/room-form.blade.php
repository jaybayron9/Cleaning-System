<div> 
    <h3 class="mb-4 text-lg font-semibold">Create Room</h3>
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
                    Room name
                </label>
            </div>
            @error('name')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div> 
        <div class="mb-4">
            <div class="relative z-0 w-full group">
                <input type="name" wire:model="capacity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Capacity
                </label>
            </div>
            @error('capacity')<span class="text-xs text-red-500">{{ $message }}</span>@enderror 
        </div>  
        <div class="mb-2 col-span-2 w-full"> 
            <label for="name" class="text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Assign employee
            </label> 
            <div class="grid grid-cols-3 gap-1">
                @foreach ($users as $employee) 
                    <div>
                        <input id="assigned_rooms_{{ $employee->id }}" type="checkbox" wire:model="assigned_rooms.{{ $employee->id }}">
                        <label for="assigned_rooms_{{ $employee->id }}" class="text-sm">
                            {{ $employee->name }}
                        </label> 
                    </div>
                @endforeach 
            </div>
            @error('assigned_rooms')<span class="text-xs text-red-500">{{ $message }}</span>@enderror  
        </div> 
        <div class="row-span-2">
            <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                Create
            </button>
        </div>
    </form>   
</div>
