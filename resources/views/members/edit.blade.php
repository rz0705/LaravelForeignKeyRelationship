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

    <h2>Edit Member</h2><br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" name="name" class="form-control" id="name" value= "{{ old('name',$editid->name) }}" autocomplete="off">
                    @error('name')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" class="form-control" id="email" value= "{{ old('email',$editid->email) }}" autocomplete="off">
                    @error('email')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="varchar" name="contact" class="form-control" id="contact" value= "{{ old('contact',$editid->contact) }}" autocomplete="off">
                    @error('contact')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="group">Group</label>
                    {{-- @dd($editid->group_id); --}}
                    <select name="group_id" class="form-control" id="group">
                        {{-- @dd($members); --}}
                        @foreach ($groups as $group)
                            <option value="{{ $group->group_id }}" @if ($group->group_id == $editid->group_id) selected @endif>
                                {{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success btn-sm">Update Member</button>
            </form>
        </div>
    </div>
@stop
