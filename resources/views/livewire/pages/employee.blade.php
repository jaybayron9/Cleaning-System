<div class="container mx-auto">
    <div class="py-4">
        <a href="{{ route('logout') }}" class="underline text-blue-500 hover:no-underline">Logout</a>
    </div>  
    <div>
        <h3 class="mb-4 text-lg font-semibold">Welcome {{ auth()->user()->name }}</h3> 
    </div>
    <livewire:tables.employee-rooms-table />
</div>
