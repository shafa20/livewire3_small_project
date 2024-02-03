@extends('layouts.app')
@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Student') }} - {{ $student->name }}
                </h2>
                @if (session('success'))
                    <div class="alert alert-success bg-blue-500 text-white">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" style="color:red">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <div
                                class="flex justify-between items-center p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                <h2>Edit Student</h2>
                                <a href="{{ route('students.index') }}"
                                    class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">All
                                    Student</a>
                            </div>
                            <form class="p-5 lg:max-w-4xl mx-auto dropzone"
                                action="{{ route('students.update', $student->id) }}" method="POST">
                                <div class="flex gap-6 flex-wrap md:flex-nowrap">
                                    <div class="w-1/2 mx-auto">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-6">
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                Name</label>
                                            <input type="text" id="name" name="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Enter student name" value="{{ old('name', $student->name) }}">
                                            @error('name')
                                                <div class="text-red-500 text-sm font-semibold">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label for="roll"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                Roll</label>
                                            <input type="number" id="roll" name="roll"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Enter student  roll" value="{{ old('roll', $student->roll) }}">
                                            @error('roll')
                                                <div class="text-red-500 text-sm font-semibold">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-6">
                                            <label for="registration"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                Registration No.
                                            </label>
                                            <input type="text" id="registration" name="registration"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Enter User registration no."
                                                value="{{ old('registration', $student->registration) }}">
                                            @error('registration')
                                                <div class="text-red-500 text-sm font-semibold">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center w-full">
                                    <button type="submit"
                                        class="mb-4 text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-4">
                                        Update Student
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
