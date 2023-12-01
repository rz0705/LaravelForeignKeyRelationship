@extends('layouts.master')

@section('content')
    <div>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete {{ $member->name }}?</p>

        <form id="delete-form" method="post" action="{{ route('members.destroy', ['id' => $member->id]) }}">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete()">Confirm Delete</button>
        </form>

        <a href="{{ url('members') }}">Cancel</a>

        <script>
            function confirmDelete() {
                var confirmation = confirm('Are you sure you want to delete?');
                if (confirmation) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
    </div>
@endsection
