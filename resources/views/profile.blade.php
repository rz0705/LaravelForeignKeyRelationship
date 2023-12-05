@extends('layouts.master')

@section('content')

<body>
    <h2>My Profile</h2><hr>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
                </div>

                <div class="mb-3">
                    <label for="oldpass" class="form-label">Old password</label>
                    <input type="password" name="oldpassword" class="form-control" id="oldpass" value="">
                </div>

                <div class="mb-3">
                    <label for="newpass" class="form-label">New password</label>
                    <input type="password" name="newpassword" class="form-control" id="newpass" value="">
                </div>

                <div class="mb-3">
                    <label for="newpassword_confirmation" class="form-label">Confirm new password</label>
                    <input type="password" name="newpassword_confirmation" class="form-control" id="newpassword_confirmation" value="">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</body>
@endsection
