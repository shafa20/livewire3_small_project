<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Unlimited Manue and Sub Manue
            </h2>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <section>
                                @if (session()->has('success'))
                                    <div
                                        class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                                        <div
                                            class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                                            <div class="text-green-600">
                                                <svg class="w-8 sm:w-7 h-8 sm:h-7" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-lg font-medium font-bold ml-3 text-green-600">Success!.
                                            </div>
                                        </div>
                                        <div class="text-lg tracking-wide text-green-600 mt-4 sm:mt-0 sm:ml-4">
                                            {{ session('success') }}</div>
                                        <div
                                            class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                                            <div wire:click="dismissSuccessMessage"
                                                class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="my-4">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        wire:click="create">Create Manue</button>
                                </div>

                                @if ($isOpen)
                                    <div class="fixed inset-0 flex items-center justify-center z-50">
                                        <div class="absolute inset-0 bg-black opacity-50"></div>
                                        <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                                            <!-- Modal content goes here -->
                                            <svg wire:click.prevent="$set('isOpen', false)"
                                                class="ml-auto w-6 h-6 text-gray-900 cursor-pointer fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                                <path
                                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                            </svg>
                                            <h2 class="text-2xl font-bold mb-4">
                                                {{ $postId ? 'Edit Post' : 'Create Post' }}</h2>

                                            <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}"
                                                enctype="multipart/form-data">
                                                <div class="mb-1">
                                                    <label for="title"
                                                        class="block text-gray-700 font-bold mb-2">Title:</label>
                                                    <input wire:model="title" type="text" id="title"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded">

                                                    <span class="text-red-500">
                                                        @error('title')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-1">
                                                    <label for="description"
                                                        class="block text-gray-700 font-bold mb-2">description:</label>
                                                    <textarea wire:model="description" id="description" rows="4"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded"></textarea>
                                                    <span class="text-red-500">
                                                        @error('description')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-1">
                                                    <label for="priority"
                                                        class="block text-gray-700 font-bold mb-2">Priority
                                                        Number:</label>
                                                    <input wire:model="priority" type="number" id="priority"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                                    <span class="text-red-500">
                                                        @error('priority')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-1">
                                                    <label for="has_menu" class="block text-gray-700 font-bold mb-2">Has
                                                        Menu:</label>
                                                    <select wire:model="has_menu" id="has_menu"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded"
                                                        style="color: black; /* Adjust font color */">
                                                        <option value="">Select Manue</option>
                                                        <option value="0">Initial Menu</option>
                                                        @foreach ($manues as $manue)
                                                            <option value="{{ $manue->id }}">{{ $manue->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-red-500">
                                                        @error('has_menu')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-1">
                                                    <label for="status"
                                                        class="block text-gray-700 font-bold mb-2">Status:</label>
                                                    <select wire:model="status" id="status"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                                        <option value="">Select status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                    <span class="text-red-500">
                                                        @error('status')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="flex justify-end">

                                                    <button type="submit"
                                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">{{ $postId ? 'Update' : 'Create' }}</button>
                                                    <button type="button"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                                        wire:click="closeModal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </section>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
                                <ul>

                                    @php
                                        function displayMenu($manues, $parentId, $level = 0)
                                        {
                                            $menus = $manues
                                                ->where('has_menu', $parentId)
                                                ->where('status', 1)
                                                ->sortBy('priority');
                                            foreach ($menus as $menu) {
                                                echo '<li style="padding-left: ' .
                                                    $level * 20 .
                                                    'px;"> -> ' .
                                                    $menu->title .
                                                    '</li>';
                                                // Recursive call to display submenus
                                                displayMenu($manues, $menu->id, $level + 1);
                                            }
                                        }
                                    @endphp

                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
                                        <ul>

                                            @foreach ($manues->where('has_menu', 0)->where('status', 1)->sortBy('priority') as $manue)
                                                <li>{{ $manue->title }}</li>
                                                @php displayMenu($manues, $manue->id); @endphp
                                            @endforeach
                                        </ul>
                                    </div>

                                </ul>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- <form>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Example multiple select</label>
        <select multiple class="form-control" id="exampleFormControlSelect2">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
</form> --}}
