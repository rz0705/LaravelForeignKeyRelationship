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

    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp

    <h2>Edit Group</h2><br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Group Name</label>
                    <input type="varchar" name="name" class="form-control" id="name" value= "{{ old('name',$editid->name) }}" autocomplete="off" autofocus>
                    @error('name')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Group Description</label>
                    <input name="description" class="form-control" id="description" value= "{{old('description',$editid->description)}}" autocomplete="off">
                    @error('description')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success btn-sm">Update Group</button>
            </form>
        </div>
    </div>
@stop
