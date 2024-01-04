<div class="container mx-auto pb-8"> 
    <div class="py-2">
        <a href="{{ route('welcome') }}" wire:navigate class="underline text-blue-500 hover:no-underline">Back</a>
    </div> 

    <p class="text-sm mb-4 ">Employee : <span class="text-md font-semibold">{{ $employee->name }}</span></p> 

    <h2 class="mb-2 text-sm font-semibold">Assigned Rooms:</h2>
    <div class="flex flex-col gap-2">
        @if (!$employeeAssigned($employee->id)->isEmpty())
            @foreach ($employeeAssigned($employee->id) as $room)
                <div class="bg-gray-50 rounded-md shadow-sm p-4 border border-gray-200">
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <h1 class="text-md font-semibold mb-2">{{ $room->room_name }}</h1>
                            @php
                                $status = match ($room->assign_status) {
                                    'pending' => 'bg-yellow-100 border border-yellow-400 text-yellow-700',
                                    'approved' => 'bg-green-100 border border-green-400 text-green-700',
                                    'rejected' => 'bg-red-100 border border-red-400 text-red-700',
                                } 
                            @endphp
                            <div class="{{ $status }} px-4 rounded relative mb-4 capitalize" role="alert"> 
                                <span class="block sm:inline">{{ $room->assign_status }}</span>
                            </div> 
                        </div>
                        <div class="flex gap-2"> 
                            <button 
                                wire:click="approve({{ $room->assign_id }}, {{ $room->user_id }})" 
                                wire:loading.attr="disabled"  
                                class="bg-green-600 hover:bg-green-500 text-white px-2 py-1 rounded active:shadow-md"
                            > 
                                <div wire:loading.remove wire:target="approve({{ $room->assign_id }}, {{ $room->user_id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                    </svg>   
                                </div>
                                <span wire:loading wire:target="approve({{ $room->assign_id }}, {{ $room->user_id }})">
                                    Loading...
                                </span>
                            </button>
                            <button 
                                wire:click="reject({{ $room->assign_id }}, {{ $room->user_id }})" 
                                wire:loading.attr="disabled" 
                                class="bg-red-500 hover:bg-red-400 text-white px-2 py-1 rounded active:shadow-md" 
                            >
                                <div wire:loading.remove wire:target="reject({{ $room->assign_id }}, {{ $room->user_id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                                    </svg> 
                                </div>

                                <span wire:loading wire:target="reject({{ $room->assign_id }}, {{ $room->user_id }})">
                                    Loading...
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-4"> 
                        @foreach ($roomImages($room->image) as $image) 
                            @if ($image)
                                <div class="relative"> 
                                    <img src="{{ Storage::url('photos/'. $image) }}" loading="lazy" alt="image" la class="w-48 h-48 border border-gray-300"> 
                                    <a href="{{ route('download.image', $image) }}" class="absolute bg-sky-100/50 hover:bg-sky-100/70 p-2 -mt-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg> 
                                    </a> 
                                </div>
                            @else
                                No uploaded image(s).
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach 
        @else
            No assigned room.
        @endif
    </div>
</div> 
