@extends('layouts.app')
@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Students
                </h2>
                @if (session('success'))
                    <div class="alert alert-success">
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
                        <div class="flex gap-6 flex-wrap lg:flex-nowrap w-full mb-6">

                            <div
                                class="flex rounded-lg mb-4 justify-between items-center py-2 px-6 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                @can('student.create')
                                    <a href="{{ route('students.create') }}">
                                        <button type="button"
                                            class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Create Student
                                        </button>
                                    </a>
                                @endcan

                                @can('student.import')
                                    <button id="importStudentBtn" type="button"
                                        class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        Import Student
                                    </button>

                                    <div id="importFormContainer" style="display: none;">
                                        <form action="{{ route('students.import') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file" accept=".xlsx, .xls" required>

                                            <button type="submit"
                                                class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Import</button>
                                        </form>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            $("#importStudentBtn").click(function() {
                                                $("#importStudentBtn").hide();
                                                $("#importFormContainer").show();
                                            });
                                        });
                                    </script>
                                @endcan


                                @can('student.export')
                                    <button type="button"
                                        class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <a href="{{ route('students.exportToExcel') }}" class="text-white">Export Student</a>
                                    </button>
                                @endcan
                            </div>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Serial No
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Name
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Role
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Registration Number
                                        </th>
                                        @if (auth()->user()->can('student.edit') ||
                                                auth()->user()->can('student.delete'))
                                            <th scope="col" class="py-3 px-6">
                                                Action
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($students->count() > 0)
                                        @php $index = ($students->currentPage() - 1) * $students->perPage() + 1; @endphp
                                        @foreach ($students as $student)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-4 px-6">
                                                    {{ $index++ }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $student->name }}
                                                </td>

                                                <td class="py-4 px-6">

                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                                        {{ $student->roll }} </span>

                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $student->registration }}
                                                </td>

                                                <td class="py-4 px-6 flex gap-2">
                                                    @can('student.edit')
                                                        <a data-tooltip-target="edit-button" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            href="{{ route('students.edit', $student->id) }}">
                                                            <x-svg.edit class="w-6 h-6 text-green-400" />
                                                        </a>
                                                    @endcan

                                                    @can('student.delete')
                                                        <form action="{{ route('students.destroy', $student->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-tooltip-target="delete-button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                onclick="return confirm('Are you sure you want to delete this student information?');">
                                                                <x-svg.trash class="w-6 h-6 text-red-400" />
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center pt-8">Nothing Found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="p-5">
                                {{ $students->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
