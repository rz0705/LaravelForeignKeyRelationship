@extends('layouts.master')

@section('content')
    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp
    
    @if(session('success'))
        <h2 style="color: green; font-size: 20px;">{{ session('success') }}</h2>
    @endif
    @if(session('delete'))
        <h2 style="color: green; font-size: 20px;">{{ session('delete') }}</h2>
    @endif

    <div class="min-h-screen flex flex-col">
        <header class="py-4">
            <div class="container mx-auto">
                <h2>All Members</h2>
        </header>
        <div class="max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md items-left p-xl-1">
                <label for="search" class="text-gray-600 ">Search:</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    class="border-black rounded px-2 py-1 focus:outline-none focus:border-blue-500" autocomplete="off" autofocus onchange="performSearch()" onfocus="moveCursorToEnd()">

                <label for="group-select" class="block text-sm font-medium text-gray-600">Filter By Group:</label>
                <select id="group-select" name="group-select[]" multiple onchange="filterMembers()"
                    class="border-black rounded px-2 py-1 focus:outline-none focus:border-blue-500 js-example-basic-multiple"
                    style="width: 100%;">
                    <option value="" selected>Select Group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->group_id }}" @if (in_array($group->group_id, $selected_groups_id)) selected @endif>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>

                <a href="{{ route('addmember') }}">
                    <button type="button" class="btn btn-outline-secondary btn-sm">Add Member</button>
                </a>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Member id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr class="member-row" data-group-id="{{ $member->group->id }}">
                        <td>{{ $member->member_id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->contact }}</td>
                        <td>{{ $member->group->name }}</td>
                        <td>
                            <a href="{{ route('edit', ['id' => $member->member_id]) }}" class="btn btn-outline-success btn-sm">Edit
                            </a>&nbsp;
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="confirmDelete('{{ $member->name }}', '{{ route('delete', ['id' => $member->member_id]) }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $members->links() }}

        <div id="output"></div>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    width: '59%', // Set a custom width, you can adjust this value accordingly
                    tags: true,
                    tokenSeparators: [',', ' '],
                    templateSelection: function(data, container) {
                        // Use a custom template for selected options to display pills
                        return $('<span>' + data.text + '</span>');
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                });
            });

            function toggleDropdown() {
                var dropdown = document.getElementById("group-select");
                dropdown.classList.toggle("show-dropdown");
            }

            function performSearch() {
                var inputValue = document.getElementById('search').value.trim();
                var selectedGroupIds = Array.from(document.getElementById('group-select').selectedOptions).map(option => option
                    .value);

                var groupQueryParam = selectedGroupIds.filter(Boolean).join(',');

                if (inputValue.length > 0) {
                    var url = "{{ route('members') }}" + '?group=' + groupQueryParam + '&search=' + inputValue;
                    window.location.href = url;
                } else {
                    window.location.href = "{{ route('members') }}";
                }
            }

            function moveCursorToEnd() {
                var input = document.getElementById('search');
                if (input) {
                    input.setSelectionRange(input.value.length, input.value.length);
                }
            }

            function filterMembers() {
                var selectedGroupIds = Array.from(document.getElementById('group-select').selectedOptions).map(option => option
                    .value);

                if (selectedGroupIds.length > 0) {
                    var url = "{{ route('members') }}" + '?group=' + selectedGroupIds.join(',');
                    window.location.href = url;
                } else {
                    window.location.href = "{{ route('members') }}";
                }
            }

            function confirmDelete(memberName, deleteUrl) {
                if (confirm(`Are you sure you want to delete ${memberName}?`)) {
                    window.location.href = deleteUrl;
                } else {
                    // If the user clicks "Cancel," do nothing.
                }
            }
        </script>
    @endsection

    @push('scripts')
        <script>
            $("#group-select").select2({
                placeholder: "Select Group",
                allowClear: true
            });
        </script>
    @endpush
