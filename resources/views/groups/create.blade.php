@extends('layouts.master')

@section('content')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <h2>Create Group</h2><br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="add">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Group Name</label>
                    <input type="varchar" name="name" class="form-control" id="name" value= "{{old('name')}}" autocomplete="off" autofocus>
                    @error('name')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Group Description</label>
                    <input name="description" class="form-control" id="description" value= "{{old('description')}}" autocomplete="off">
                    @error('description')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success btn-sm">Add Group</button>
            </form>
        </div>
    </div>
@stop
