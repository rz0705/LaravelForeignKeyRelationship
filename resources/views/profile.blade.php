@extends('layouts.master')

@section('content')

<body>
    <h2>My Profile</h2><hr>
    Details:
    <br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('updateprofile.post') }}">
                @csrf
                @method('POST')
                
                @if(session()->has('danger'))
                    <div class="alert alert-success">
                        {{ session()->get('danger') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('app.profile.name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name',auth()->user()->name) }}" autocomplete="off">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('app.profile.email') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email',auth()->user()->email) }}" autocomplete="off">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Update</button>
                
            </form>
        </div>
    </div>
    <br>
    Change Password:
    <br>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('updatepassword.post') }}">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="oldpass" class="form-label">{{ __('app.profile.oldpassword') }}</label>
                        <input type="password" name="oldpassword" class="form-control @error('password') is-invalid @enderror" id="oldpass" value="" autocomplete="off">
                        @error('oldpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('app.profile.password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('app.profile.password_confirmation') }}</label>
                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Change Password</button>

        </div>
    </div>
</body>
@endsection
