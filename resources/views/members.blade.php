@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between">
        <h2>All Members
        </h2>
        <a href="{{ route('add') }}">
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
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $members->links() }}
@endsection
