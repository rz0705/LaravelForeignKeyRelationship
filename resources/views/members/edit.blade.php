@extends('layouts.master')

@section('content')

    @php
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(',', $group_id);
    @endphp

    <h2>Edit Member</h2><br>
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
                    <label for="name" class="form-label">{{ __('app.member.name') }}</label>
                    <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value= "{{ old('name',$editid->name) }}" onfocus="moveCursorToEnd()" autocomplete="off" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('app.member.email') }}</label>
                    <input name="email" class="form-control @error('email') is-invalid @enderror" id="email" value= "{{ old('email',$editid->email) }}" autocomplete="off">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">{{ __('app.member.contact') }}</label>
                    <input type="varchar" name="contact" class="form-control @error('contact') is-invalid @enderror" id="contact" value= "{{ old('contact',$editid->contact) }}" autocomplete="off">
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
                            <option value="{{ $group->group_id }}" @if ($group->group_id == $editid->group_id) selected @endif>
                                {{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Update Member</button>
                
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
