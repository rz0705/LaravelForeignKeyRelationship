@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between">
        <h2>All Members
        </h2>
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
                <tr>
                    <td>{{ $member->member_id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->contact }}</td>
                    <td>{{ $member->group->name }}</td>
                    <td>
                        <a href="{{ route('edit', ['id' => $member->member_id]) }}">
                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                        </a>&nbsp;

                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $member->name }}', '{{ route('delete', ['id' => $member->member_id]) }}')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $members->links() }}

    <script>
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
