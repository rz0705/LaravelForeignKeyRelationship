@extends('layouts.master')

@section('content')

    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp

    <h2>Edit Group</h2><br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                @csrf

                @if(session()->has('danger'))
                    <div class="alert alert-success">
                        {{ session()->get('danger') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('app.group.name') }}</label>
                    <input type="varchar" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value= "{{ old('name',$editid->name) }}" onfocus="moveCursorToEnd()" autocomplete="off" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('app.group.description') }}</label>
                    <input name="description" class="form-control @error('description') is-invalid @enderror" id="description" value= "{{old('description',$editid->description)}}" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Update Group</button>

            </form>
        </div>
    </div>

    <script>
        function moveCursorToEnd() {
                var input = document.getElementById('name');
                if (input) {
                    input.setSelectionRange(input.value.length, input.value.length);
                }
            }
    </script>
@stop
