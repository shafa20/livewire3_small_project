@extends('layouts.app')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Role Edit
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
                                <h2>Role Edit</h2>
                                <a href="{{ route('roles.index') }}">
                                    <button type="button"
                                        class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        All Roles
                                    </button>
                                </a>
                            </div>
                            <form action="{{ route('roles.update', $role->id) }}" method="POST" class="p-4">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="name"
                                        class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-300">Name</label>
                                    <input type="text" value="{{ old('name', $role->name) }}" id="name"
                                        name="name"
                                        class="@error('name') border-red-500 @enderror pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Enter Role Name">
                                    @error('name')
                                        <div class="text-red-500 text-sm font-semibold">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="gap-6 mb-6 px-6 py-4 bg-white">
                                    @foreach ($permissions as $permission)
                                        <div class="ml-3 role-management-checkbox">
                                            <input onclick="checksinglepermission('role-management-checkbox','management')"
                                                name="permissions[]" id="permission_checkbox" value="{{ $permission->id }}"
                                                type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                @if (in_array($permission->id, $data)) checked @endif>
                                            <label for="permission{{ $permission->id }}"
                                                class="ml-2 text-lg text-gray-900 dark:text-gray-300">
                                                {{ $permission->name }} <br>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit"
                                    class="mb-4 text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-4">
                                    Update Role
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    $('#permission_all').on('click', function() {
                        if ($(this).is(':checked')) {
                            // check all the checkbox
                            $('input[type=checkbox]').prop('checked', true);
                        } else {
                            // uncheck all the checkbox
                            $('input[type=checkbox]').prop('checked', false);
                        }
                    });

                    // check permission by group
                    function CheckPermissionByGroup(classname, checkthis) {
                        const groupIdName = $("#" + checkthis.id);
                        const classCheckBox = $('.' + classname + ' input');
                        if (groupIdName.is(':checked')) {
                            // check all the checkbox
                            classCheckBox.prop('checked', true);
                        } else {
                            // uncheck all the checkbox
                            classCheckBox.prop('checked', false);
                        }
                        implementallcheck();
                    }

                    function checksinglepermission(groupClassname, groupId, countTotalPermission) {
                        const classCheckbox = $('.' + groupClassname + ' input');
                        const groupIDCheckBox = $('#' + groupId);

                        // if there is any occurance where somthing is not selected then make select check
                        if ($('.' + groupClassname + ' input:checked').length == countTotalPermission) {
                            groupIDCheckBox.prop('checked', true);
                        } else {
                            groupIDCheckBox.prop('checked', false);
                        }
                        implementallcheck();
                    }

                    function implementallcheck() {
                        const countPermisssions = 5;
                        const countPermisssionsGroup = 3;
                        var amount = countPermisssions + countPermisssionsGroup;

                        var checkbox = $("input:checked").length;

                        if (amount == checkbox) {
                            $('#permission_all').prop('checked', true);
                        } else {
                            $('#permission_all').prop('checked', false);
                        }
                    }
                </script>
            </div>
        </section>
    </div>
@endsection
