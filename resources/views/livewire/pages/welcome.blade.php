<div class="container mx-auto pb-10">
    <div class="py-2">
        <a href="{{ route('login') }}" wire:navigate class="underline text-blue-500 hover:no-underline">Login Employee</a>
    </div>
    <div class="grid md:grid-cols-2 gap-5"> 
        <div>
            <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                <livewire:forms.employee-form />
            </div>
        </div>
        <div>
            <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                <livewire:forms.room-form /> 
            </div> 
        </div>
        <div>
            <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                <livewire:tables.employees-table/>  
            </div>
        </div>
        <div>
            <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                <livewire:tables.rooms-table/>  
            </div>
        </div>
    </div>
</div>
