@extends('layouts.master')

@section('content')
    <h2>Create Group</h2><br>
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
                    <label for="name" class="form-label">{{ __('app.group.name') }}</label>
                    <input type="varchar" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value= "{{old('name')}}" autocomplete="off" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('app.group.description') }}</label>
                    <input name="description" class="form-control @error('description') is-invalid @enderror" id="description" value= "{{old('description')}}" autocomplete="off">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Add Group</button>
                
            </form>
        </div>
    </div>
@stop
