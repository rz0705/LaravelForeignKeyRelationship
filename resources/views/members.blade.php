@extends('layouts.master')

@section('content')
    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp

    <div class="d-flex">
        <h2>All Members</h2>
        <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
            <div class="flex items-left p-xl-1">
                <label for="search" class="text-gray-600 ">Search:</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" class="border-black rounded px-2 py-1 focus:outline-none focus:border-blue-500" onchange="performSearch()" autofocus onfocus="moveCursorToEnd()" >
            </div>

            <label for="group-select" class="block text-sm font-medium text-gray-600">Filter By Group:</label>
            <select id="group-select" name="group-select[]" multiple onchange="filterMembers()"
                class="border-black rounded px-2 py-1 focus:outline-none focus:border-blue-500">
                <option value="" selected>Select Group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->group_id }}" @if (in_array($group->group_id, $selected_groups_id)) selected @endif>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('addmember') }}">
            <button type="button" class="btn btn-outline-secondary btn-sm">Add Member</button>
        </a>
    </div><br>
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
                        <a href="{{ route('edit', ['id' => $member->member_id]) }}">
                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
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
        function performSearch() {
            var inputValue = document.getElementById('search').value.trim();
            var selectedGroupIds = Array.from(document.getElementById('group-select').selectedOptions).map(option => option.value);

            // Filter out empty values and join the array into a string
            var groupQueryParam = selectedGroupIds.filter(Boolean).join(',');

            if (inputValue.length > 0) {
                var url = "{{ route('members') }}" + '?group=' + groupQueryParam + '&search=' + inputValue;
                window.location.href = url;
            } else {
                // If no search input, you may want to handle it differently or redirect to the default URL
                window.location.href = "{{ route('members') }}";
            }
        }

        function moveCursorToEnd() {
            var input = document.getElementById('search');
            if (input) {
                // Move the cursor to the end of the input
                input.setSelectionRange(input.value.length, input.value.length);
            }
        }

        function filterMembers() {
            var selectedGroupIds = Array.from(document.getElementById('group-select').selectedOptions).map(option => option.value);

            // Check if there are selected group IDs
            if (selectedGroupIds.length > 0) {
                var url = "{{ route('members') }}" + '?group=' + selectedGroupIds.join(',');
                window.location.href = url;
            } else {
                // If no group is selected, you may want to redirect to the default URL or handle it differently
                window.location.href = "{{ route('members') }}";
            }
        }

        function confirmDelete(memberName, deleteUrl) {
            if (confirm(`Are you sure you want to delete ${memberName}?`)) {
                // If the user clicks "OK" in the confirmation dialog, proceed with the deletion.
                window.location.href = deleteUrl;
            } else {
                // If the user clicks "Cancel," do nothing.
            }
        }
    </script>
@endsection
