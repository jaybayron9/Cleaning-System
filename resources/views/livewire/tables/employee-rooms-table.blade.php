<div>  
    <div x-data="{
            showModal: false,
        }">
        <h3>Your room(s)</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-xs whitespace-nowrap text-center">ROOM ID</th>
                    <th class="text-xs whitespace-nowrap text-center">ROOM NAME</th>
                    <th class="text-xs whitespace-nowrap text-center">CREATED AT</th>
                    <th class="text-xs whitespace-nowrap text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignedRooms as $employee)
                    <tr>
                        <td>{{ $employee->room_id }}</td>
                        <td>{{ $employee->room_name }}</td>
                        <td>{{ date('Y/m/d', strtotime($employee->room_created)) }}</td>
                        <td class="text-center">
                            <button 
                                type="button"
                                @click="showModal = true"
                                x-on:click="@this.modalId({{ $employee->assign_id }})"
                                class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-200 text-sm font-medium px-3 active:shadow hover:text-gray-900">
                                Upload image
                            </button> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div x-show="showModal" x-transition x-cloak class="flex items-center justify-center fixed top-0 left-0 right-0 z-50 h-full w-full overflow-auto bg-gray-800 bg-opacity-50"> 
            <div class="relative p-4 w-full max-w-2xl max-h-full"> 
                <form wire:submit="uploadImages" class="relative bg-white rounded-lg shadow"> 
                    <input type="hidden" wire:model="assign_id" />
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Upload Images
                        </h3>
                        <button type="button" @click="showModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div> 
                    <div class="p-4 md:p-5 space-y-4">  
                        @error('images')
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"> 
                                <span class="block sm:inline">{{ $message }}</span>
                            </div> 
                        @enderror
                        <div
                            x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <div class="flex mb-4"> 
                                <input 
                                    multiple
                                    type="file" 
                                    wire:model="images"
                                    accept="image/*" 
                                    class="block w-full text-sm text-gray-900 cursor-pointer"
                                />
                                <div class="flex">
                                    <div x-show="uploading">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <div wire:loading wire:target="images">Uploading...</div>
                                </div>
                                @error('images.*') <span class="error">{{ $message }}</span> @enderror  
                            </div>
                            @if ($images) 
                                <div class="grid grid-cols-4">
                                    @foreach ($images as $image)
                                        <img src="{{ $image->temporaryUrl() }}" class="h-32 w-32 border border-gray-300"> 
                                    @endforeach
                                </div>
                            @endif
                        </div> 
                    </div>
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Upload
                        </button>
                        <button @click="showModal = false" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 