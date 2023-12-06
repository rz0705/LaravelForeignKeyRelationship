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
                
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                {{-- Display validation errors --}}
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name }}">
                    @error('name')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
                    @error('email')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label for="oldpass" class="form-label">Old password</label>
                    <input type="password" name="oldpassword" class="form-control" id="oldpass" value="">
                    @error('oldpassword')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="newpass" class="form-label">New password</label>
                    <input type="password" name="newpassword" class="form-control" id="newpass" value="">
                    @error('newpassword')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="newpassword_confirmation" class="form-label">Confirm new password</label>
                    <input type="password" name="newpassword_confirmation" class="form-control" id="newpassword_confirmation" value="">
                    @error('newpassword_confirmation')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <button type="submit" class="btn btn-success">Update</button> --}}
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
                
                @if(session()->has('danger'))
                    <div class="alert alert-success">
                        {{ session()->get('danger') }}
                    </div>
                @endif

                {{-- Display validation errors --}}
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="mb-3">
                    <label for="oldpass" class="form-label">Old password</label>
                    <input type="password" name="oldpassword" class="form-control" id="oldpass" value="">
                    @error('oldpassword')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="newpass" class="form-label">New password</label>
                    <input type="password" name="newpassword" class="form-control" id="newpass" value="">
                    @error('newpassword')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="newpassword_confirmation" class="form-label">Confirm new password</label>
                    <input type="password" name="newpassword_confirmation" class="form-control" id="newpassword_confirmation" value="">
                    @error('newpassword_confirmation')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm">Change Password</button>
        </div>
    </div>
</body>
@endsection
