<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo
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
                                            <div class="text-green-600"">
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
                                @can('todo.create')
                                    <div class="my-4">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            wire:click="create">Add Post</button>
                                    </div>
                                @endcan
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
                                                <div class="mb-4">
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
                                                <div class="mb-4">
                                                    <label for="image"
                                                        class="block text-gray-700 font-bold mb-2">Image:</label>
                                                    <input wire:model="image" type="file" id="image"
                                                        accept="image/jpeg, image/png"
                                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                                    @if ($imagePreview)
                                                        <img src="{{ $imagePreview }}" alt="Image Preview"
                                                            style="width: 80px; height: 100px;" class="mt-2">
                                                    @endif

                                                    @if ($postId && !$imagePreview)
                                                        <td class="px-6 py-4">
                                                            <img src="{{ asset('storage/' . $image) }}" alt="Post Image"
                                                                style="width: 80px; height: 100px;">
                                                        </td>
                                                    @endif

                                                    <span class="text-red-500">
                                                        @error('image')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-4">
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
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Serial No
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Title
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Image
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Description
                                            </th>
                                            @if (auth()->user()->can('todo.edit') ||
                                                    auth()->user()->can('todo.delete'))
                                                <th scope="col" class="px-6 py-3">
                                                    Action
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    @forelse ($posts as $post)
                                        <tbody wire:key="{{ $post->id }}">
                                            <tr class="bg-white border-b">
                                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ ++$counter }}
                                                </td>
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $post->title }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    <img src="{{ url('/storage/' . $post->image) }}" alt="Post Image"
                                                        style="width: 80px; height: 100px;">
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $post->description }}
                                                </td>

                                                <td class="px-6 py-4">
                                                    @can('todo.edit')
                                                        <button class="" wire:click="edit({{ $post->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="ml-2 mt-0 w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </button>
                                                    @endcan
                                                    @can('todo.delete')
                                                        <button class="" wire:click="delete({{ $post->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="ml-2 mt-0 w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a2.25 2.25 0 011.897 1.13l1.087 2.902a2.25 2.25 0 01-1.13 2.897L18.157 19.672M4.773 5.79L3.685 8.692a2.25 2.25 0 01-1.13 1.898l-1.086.456a2.25 2.25 0 01-2.897-1.13L2.822 3.328a2.25 2.25 0 011.13-2.897L6.235.328M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.11 48.11 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        </tbody>
                                    @empty
                                        <p>No post found</p>
                                    @endforelse
                                </table>

                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
