@extends('layouts.master')

@section('content')
    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp

    @if(session('success'))
        <h2 style="color: green; font-size: 20px;">{{ session('success') }}</h2>
    @endif
    @if(session('exist'))
        <h2 style="color: red; font-size: 20px;">{{ session('exist') }}</h2>
    @endif
    <div class="min-h-screen flex flex-col">
        <header class="py-4">
            <div class="container mx-auto">
                <h2>All Groups</h2>
        </header>
        <div class="max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md items-left p-xl-1">
                <label for="search" class="text-gray-600 ">Search:</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    class="border-black rounded px-2 py-1 focus:outline-none focus:border-blue-500"
                    onchange="performSearch()" autofocus onfocus="moveCursorToEnd()">

                <a href="{{ route('addgroup') }}">
                    <button type="button" class="btn btn-outline-secondary btn-sm">Add Group</button>
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Group id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date to Creation</th>
                    <th>Last Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                <tr class="group-row" data-group-id="{{ $group->id }}">
                    <td>{{ $group->group_id }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->description }}</td>
                    <td>{{ $group->created_at}}</td>
                    <td>{{ $group->updated_at }}</td>
                    <td>
                        <a href="{{ route('editgroup', ['id' => $group->group_id]) }}" class="btn btn-outline-success btn-sm">Edit
                        </a>&nbsp;
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            onclick="confirmDelete('{{ $group->name }}', '{{ route('deletegroup', ['id' => $group->group_id]) }}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $groups->links() }}

        <div id="output"></div>

        <script>
            function performSearch() {
                var inputValue = document.getElementById('search').value.trim();

                if (inputValue.length > 0) {
                    var url = "{{ route('groups') }}" + '?search=' + inputValue;
                    window.location.href = url;
                } else {
                    window.location.href = "{{ route('groups') }}";
                }
            }

            function moveCursorToEnd() {
                var input = document.getElementById('search');
                if (input) {
                    input.setSelectionRange(input.value.length, input.value.length);
                }
            }

            function confirmDelete(groupName, deleteUrl) {
                if (confirm(`Are you sure you want to delete ${groupName}?`)) {
                    window.location.href = deleteUrl;
                } else {
                    // If the user clicks "Cancel," do nothing.
                }
            }
        </script>
    @endsection
