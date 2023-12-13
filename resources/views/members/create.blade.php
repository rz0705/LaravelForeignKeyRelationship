@extends('layouts.master')

@section('content')
    <h2>Create Member</h2><br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="add">
                @csrf

                @if(session()->has('danger'))
                    <div class="alert alert-success">
                        {{ session()->get('danger') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('app.member.name') }}</label>
                    <input type="varchar" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value= "{{old('name')}}" autocomplete="off" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('app.member.email') }}</label>
                    <input name="email" class="form-control @error('email') is-invalid @enderror" id="email" value= "{{old('email')}}" autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">{{ __('app.member.contact') }}</label>
                    <input type="varchar" name="contact" class="form-control @error('contact') is-invalid @enderror" id="contact" value= "{{old('contact')}}" autocomplete="off">
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="group">{{ __('app.member.group') }}</label>
                    <select name="group_id" class="form-control" id="group">
                        @foreach ($groups as $group) 
                            <option value="{{$group->group_id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Add Member</button>

            </form>
        </div>
    </div>
@stop
